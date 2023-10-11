<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Session;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookSignin()
    {
        try {
    
            $user = Socialite::driver('facebook')->user();
            $facebookId = Customer::where('facebook_id', $user->id)->first();
     
            if($facebookId){
                // Auth::login($facebookId);
                Session::put("customer",  $facebookId);
                return redirect('/');
            }else{
                $createUser = Customer::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id' => $user->id,
                    'password' => encrypt('john123')
                ]);
                
                Session::put("customer",  $createUser);
                // Auth::login($createUser);
                return redirect('/');
            }
    
        } catch (Exception $exception) {
            dd(123);
            dd($exception->getMessage());
        }
    }
}
