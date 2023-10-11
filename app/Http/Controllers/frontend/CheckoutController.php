<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $listCategory = Category::get();
        $listHotCategory = Category::where('display_home',true)->get();

        return view('frontend.checkout',[
            'listCategory' => $listCategory,
            'listHotCategory' => $listHotCategory,
        ]);
    }
    // public function postPaymentStripe(Request $request)
    // {
    //     $request->validate([
    //         'card-number' => 'required',
    //         'cvv' => 'required',
    //         'exp' => 'required',
    //     ]);
        
    //     $stripe = Stripe::setApiKey(env('STRIPE_SECRET'));
    //     try {
    //         // $token = $stripe->tokens()->create([
    //         //     'card' => [
    //         //         'number' => $request->card_number,
    //         //         'exp_month' => date('m', strtotime($request->exp)),
    //         //         'exp_year' => date('Y', strtotime($request->exp)),
    //         //         'cvc' => $request->cvv,
    //         //     ],
    //         // ]);
    //         // if (!isset($token['id'])) {
    //         //     dd("hiepdz1");
    //         //     // return redirect()->route('checkout.index');
    //         // }
    //         $charge = Charge::create([
    //             'customer' => 'hipezd',
    //             'amount' => 1999,
    //             'currency' => 'usd'
    //         ]);
    
    //         if($charge['status'] == 'succeeded') {
    //             dd("hiep2");
    //             // return redirect()->route('homeFrontend.index');
    //         } else {
    //             dd("hiep3");
    //             // Session::put('error','Money not add in wallet!!');
    //             // return redirect()->route('checkout.index');
    //         }
    //     } catch (Exception $e) {
    //         dd("hiep4");
    //         // Session::put('error',$e->getMessage());
    //         // return redirect()->route('addmoney.paymentstripe');
    //     } catch(CardException $e) {
    //         dd("hiep5");
    //         // Session::put('error',$e->getMessage());
    //         // return redirect()->route('addmoney.paywithstripe');
    //     }
    // }
    public function postPaymentStripe(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // $customer = Customer::create(array(
        //     'email' => $request->stripeEmail,
        //     'source'  => $request->stripeToken
        // ));

        $charge = Charge::create(array(
            'amount'   => 1999,
            'currency' => 'usd',
            'description' => 'Example charge',
		    'source' => Str::random(64),
        ));
    }

}
