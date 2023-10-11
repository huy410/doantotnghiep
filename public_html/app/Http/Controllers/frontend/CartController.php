<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Events\NotificationOrder;
use App\Models\WarrantyProduct;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Exception\MissingParameterException;
use Cartalyst\Stripe\Stripe;
use Exception;
use Stripe\Error\Card;
use App\Models\Customer;
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\Mail;
use App\Mail\CheckoutAlert;


class CartController extends Controller
{
    public function index()
    {
        $listCategory = Category::get();
        $listHotCategory = Category::where('display_home',true)->get();

        return view('frontend.cart-checkout',[
            'listCategory' => $listCategory,
            'listHotCategory' => $listHotCategory,
        ]);
    }

    public function quickAddToCart($id)
    {
        $product = Product::where('id', $id)->first();
        if(Session::has('carts')){

            $carts = Session::get('carts', []);
            foreach ($carts as $key => $cart) {
                if ($cart['product']['id'] == $id) {

                    $carts[$key]['quantity'] += 1;
                    Session::put('carts', $carts);

                    if(Session::has('taskUrl')) {
                        return redirect(Session::get('taskUrl'));
                    }
                    return redirect(route('cart.index'));
                }
            }
        }
        Session::push('carts', ['product' => $product, 'quantity' => '1']);
        if(Session::has('taskUrl')) {
            return redirect(Session::get('taskUrl'));
        }
        return redirect(route('cart.index'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::where('id', $request->productId)->first();

        if(Session::has('carts')){

            $carts = Session::get('carts');
            
            foreach ($carts as $key => $cart) {
                if ($cart['product']['id'] == $product->id) {

                    $carts[$key]['quantity'] =  $carts[$key]['quantity'] + $request->quantity;
                    Session::put('carts', $carts);
                    
                    return redirect(route('cart.index'));
                }
            }
        }

        Session::push('carts', ['product' => $product, 'quantity' => $request->quantity]);
        return redirect(route('cart.index'));
    }

    public function clearCart()
    {
        Session::forget('carts');
        return redirect(route('cart.index'));
    }

    public function clearItem($id)
    {
        $carts = Session::get('carts');
        foreach ($carts as $key => $cart) {
            if($cart['product']['id'] == $id) {
                unset($carts[$key]);
                Session::put('carts', $carts);
                return redirect(route('cart.index'));
            }
        }
        return redirect(route('cart.index'));
    }

    public function update(Request $request) {
        $carts = Session::get('carts');

        foreach ($carts as $key => $cart) {

                $a = $cart['product']['id'];
                $b = $request->$a;

                $carts[$key]['quantity'] = $b;

        }
        Session::put('carts', $carts);

        return redirect(route('cart.index'));
    }

    public function checkoutCart(Request $request)
    {
        $request->validate([
            'position' => 'required|min:10|max:255',
        ]);

        if(Session::has('carts')){
            $order = Order::create([
                'total_price' => $request->price,
                'position' => $request->position,
                'customer_id' =>  Session::get('customer')['id'], 
                'created_at' => now(),
                'payment_method' => 'truc tiep',
                'payment_status' => '0',
                'ship_status' => '0',
            ]);
            
            foreach (Session::get('carts') as $cart) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $cart['product']['id'],
                    'quantity' => $cart['quantity'],
                    'price' => ($cart['product']['price'] - ($cart['product']['price']*$cart['product']['discount'])/100)*$cart['quantity'],
                ]);
                
                WarrantyProduct::create([
                    'product_id' => $cart['product']['id'],
                    'order_id' => $order->id,
                    'expired' => date('Y-m-d', strtotime(now()) + 15552000),
                ]);

                Product::where('id', $cart['product']['id'])->update([
                    'remaining' => $cart['product']['remaining'] - $cart['quantity']
                ]);
            }
            
            $customer = Customer::find(Session::get('customer')['id']);
            Mail::to($customer->email)->send(new CheckoutAlert($order));
            
            $productLink = route('productFrontend.index', [Session::get('carts')[0]['product']['id']]);
            $timeBuyProduct = strtotime(date('Y-m-d H:i:s'));
            $productName = Session::get('carts')[0]['product']['name'];
            $productImage = Session::get('carts')[0]['product']['image'];

            event(new NotificationOrder($productName, $timeBuyProduct, $productLink, $productImage));

            Session::forget('carts');
            return redirect('/')->with('message', 'Thanh toán thành công');
        }
        return redirect(route('cart.index'));
    }

    public function checkoutByCard(Request $request)
    {
        $request->validate([
            'cardNumber' => 'required',
            'expired' => 'required',
            'CVC' => 'required',
            'position' => 'required',
        ]);

        if(Session::has('carts')){

            $stripe = Stripe::make(config('services.stripe.secret'));

            try {
                $token = $stripe->tokens()->create([
                    'card' => [
                    'number' => $request->cardNumber,
                    'exp_month' => date('m',strtotime($request->expired)),
                    'exp_year' => date('y',strtotime($request->expired)),
                    'cvc' => $request->CVC,
                    ],
                ]);
                if(!isset($token['id'])) {
                    return redirect(route('cart.index'));
                }
                
                $customer = $stripe->customers()->create([
                    'email' => Session::get("customer")->email,
                    'name' => Session::get("customer")->name,
                    'source' => $token['id'],
                ]);

                $charge = $stripe->charges()->create([
                    'customer' => $customer['id'],
                    'currency' => 'VND',
                    'amount' => $request->price,
                    'description' => 'thanh toan'
                ]);

                if($charge['status'] == 'succeeded') {
                    $order = Order::create([
                        'total_price' => $request->price,
                        'position' => $request->position,
                        'customer_id' =>  Session::get('customer')['id'], 
                        'created_at' => now(),
                        'payment_method' => 'stripe',
                        'payment_status' => '1',
                        'ship_status' => '0',
                    ]);
                    
                    foreach (Session::get('carts') as $cart) {
                        OrderDetail::create([
                            'order_id' => $order->id,
                            'product_id' => $cart['product']['id'],
                            'quantity' => $cart['quantity'],
                            'price' => ($cart['product']['price'] - ($cart['product']['price']*$cart['product']['discount'])/100)*$cart['quantity'],
                        ]);
        
                        Product::where('id', $cart['product']['id'])->update([
                            'remaining' => $cart['product']['remaining'] - $cart['quantity']
                        ]);
                    }
        
                    $productLink = route('productFrontend.index', [Session::get('carts')[0]['product']['id']]);
                    $timeBuyProduct = strtotime(date('Y-m-d H:i:s'));
                    $productName = Session::get('carts')[0]['product']['name'];
                    $productImage = Session::get('carts')[0]['product']['image'];
        
                    event(new NotificationOrder($productName, $timeBuyProduct, $productLink, $productImage));
        
                    Session::forget('carts');
                    
                    $customer = Customer::find(Session::get('customer')['id']);
                    Mail::to($customer->email)->send(new CheckoutAlert($order));
        
                    return redirect('/')->with('message', 'Thanh toán thành công');
                } else {
                    Session::flash('moneyError','Money not add in wallet!!');
                    return redirect(route('cart.index'));
                }
            } catch (Exception $e) {
                Session::flash('moneyError',$e->getMessage());
                return redirect(route('cart.index'));
            } catch(CardErrorException $e) {
                Session::flash('moneyError',$e->getMessage());
                return redirect(route('cart.index'));
            } catch(MissingParameterException $e) {
                Session::flash('moneyError',$e->getMessage());
                return redirect(route('cart.index'));
            }
        }
        
            
        return redirect(route('cart.index'));
    }
}
