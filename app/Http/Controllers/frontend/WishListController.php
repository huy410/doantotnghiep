<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\WishLists;
use Illuminate\Support\Facades\Session;

class WishListController extends Controller
{
    public function addToWishList($customerId, $productId)
    {
        if(empty(WishLists::where('product_id', $productId)->where('customer_id', $customerId)->first())) {
            WishLists::create([
                'customer_id' => $customerId,
                'product_id' => $productId,
            ]);

            $wishLists = WishLists::where('customer_id', $customerId)->get();
            Session::put("wish_list", $wishLists);
        }
        if(Session::has('task_url')) {
            return redirect(Session::get('task_url'));
        }
        return redirect(route('homeFrontend.index'));
    }
}
