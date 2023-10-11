<?php

namespace App\Http\Controllers\frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\VerifyEmail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\MailUserVerify;
use App\Mail\MailResetPasswordVerify;
use Carbon\Carbon;
use App\Models\UsersVerify;
use App\Models\password_reset;
use App\Models\Customer;
use App\Models\WishLists;

class LoginController extends Controller
{
    
    public function login()
    {
        return view('frontend.login.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:20'
        ]);
        
        // $password = md5($request->password);
        $remember = $request->has('remember') ? true : false;
        $customer = Customer::where('email', $request->email)->first();
        // ->where('password', $password)
        
        // if(Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password],$remember)) {
        if (!empty($customer)) {
            if($remember) {
                setcookie('customer',  $customer->token, time() + 600);
            }

            Session::put("customer",  $customer);
            
            $wishLists = WishLists::where('customer_id', $customer->id)->get();
            Session::put("wish_list", $wishLists);

            if(Session::has('taskUrl')) {
                return redirect(Session::get('taskUrl'));
            }
            return redirect('/');
        } else {
            Session::flash('error','Sai ten dang nhap hoac mat khau');
          
            return redirect('/login');
        }
    }

    public function Register() {
        return view('frontend.login.register');
    }

    public function RegisterPost(Request $request) {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:5|max:20|confirmed'
        ]);
        
        $token = Str::random(64);
        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => md5($request->password),
            'remember_token' => $token,
        ]);

        $customer = Customer::where('email', $request->email)->first();
        $token = Str::random(64);
        UsersVerify::create([
            'customer_id' => $customer->id, 
            'token' => $token
        ]);

        $url = route('user.verify', $token);
        $mailRegister = new MailUserVerify($url);
        // $queueVerifyMail = new VerifyEmail($mailRegister, $request->email);
        Mail::to( $request->email)->send($mailRegister);
        // dispatch($queueVerifyMail);

        return view('emails.waitingVerifyEmail');
    }

    public function verifyRegisterAccount($token)
    {
        $verifyUser = UsersVerify::where('token', $token)->first();
  
        $message = 'Sorry your email cannot be identified.';
  
        if(!is_null($verifyUser) ){
            $getUser = $verifyUser->customer;
  
            if(!$getUser->is_email_verified) {
                $verifyUser->customer->is_email_verified = 1;
                $verifyUser->customer->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }
        return redirect(route('frontend.login'))->with('message', $message);
    }

    public function forgotPassword()
    {
        return view('frontend.login.forgotPassword');
    }

    public function forgotPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:20|confirmed'
        ]);

        $customer = Customer::where('email', $request->email)->first(); 
        if(empty($customer)) {
            Session::flash('error','Email chưa đăng ký');
            return redirect(route('LoginController.forgotPassword'));
        } else  if($customer->is_email_verified != 1) {
            Session::flash('error','Email chưa xác thực');
            return redirect(route('LoginController.forgotPassword'));
        }
        
        $token = Str::random(64);
         password_reset::create([
            'email' => $request->email,
            'password' => md5($request->password),
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        //vi queue chay tren localhost nen route se su dung localhost thay vi 127.0.0.1:8000
        // nen la phai vt route o ngoai
        $url = route('password.verify', $token);
        $mailResetPassword = new MailResetPasswordVerify($url);
        $queueVerifyMail = new VerifyEmail($mailResetPassword, $request->email);
        dispatch($queueVerifyMail);
        
        return view('emails.waitingVerifyEmail');
    }

    public function verifyResetPassword($token)
    {
        $verifyUser = password_reset::where('token', $token)->first();

        if(!is_null($verifyUser) ){
            $customer = Customer::where('email', $verifyUser->email)->first(); 
            $customer->update([
                'password' => $verifyUser->password,
            ]);
            return redirect(route('frontend.login'))->with('message', 'Cập nhật mật khẩu thành công. Vui lòng đăng nhập lại');
        }

        return redirect(route('frontend.login'))->with('message', 'Loi');
    }

    public function logout()
    {
        Session::forget('customer');
        return redirect('login');
    }

}
