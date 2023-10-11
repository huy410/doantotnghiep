<?php

namespace App\Http\Controllers\backend;

use App\Events\UserStatusEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Jobs\VerifyEmail;
use Illuminate\Support\Facades\Session;;
use Illuminate\Support\Str;
use App\Mail\MailResetPasswordVerify;
use Carbon\Carbon;
use App\Repositories\User\UserRepositoryInterface;
use App\Models\password_reset;

class LoginController extends Controller
{
    protected $user;
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function login()
    {
        
        return view('admin.login.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:20'
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            event(new UserStatusEvent(Auth::user()));   
            return redirect('/admin');
        } else {
            Session::flash('error','Sai ten dang nhap hoac mat khau');
            return redirect('/admin/login');
        }
        
    }

    public function forgotPassword()
    {
        return view('admin.login.forgotPassword');
    }

    public function forgotPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:20|confirmed'
        ]);
        $user = $this->user->selectEmail($request); 
        if(empty($user)) {
            Session::flash('error','Email không tồn tại');
            return redirect(route('LoginController.forgotPassword'));
        }
        $token = Str::random(64);
        $passwordReset = password_reset::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        // Mail::to($request->email)->send(new MailResetPasswordVerify($passwordReset));
       
        $mailResetPassword = new MailResetPasswordVerify($passwordReset);
        $queueVerifyMail = new VerifyEmail($mailResetPassword, $request->email);
        dispatch($queueVerifyMail);

        return view('emails.waitingVerifyEmail');
    }

    public function verifyResetPassword($token)
    {
        $verifyUser = password_reset::where('token', $token)->first();

        if(!is_null($verifyUser) ){
            $user = $this->user->selectEmail($verifyUser);
            $user->update([
                'password' => $verifyUser->password,
            ]);
            return redirect(route('LoginController.login'))->with('message', 'Cập nhật mật khẩu thành công. Vui lòng đăng nhập lại');
        }

        return redirect(route('LoginController.login'))->with('message', 'Loi');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }

}
