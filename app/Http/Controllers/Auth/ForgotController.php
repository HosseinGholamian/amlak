<?php

namespace App\Http\Controllers\Auth;


use App\Http\Requests\Auth\ForgotRequest;
use App\User;
use App\Http\Services\ImageUpload;
use App\Http\Services\MailService;
use System\Auth\Auth;
use System\Session\Session;


class ForgotController
{
    private $redirectTo = '/home';
    private $redirectToAdmin = '/admin';


    public function view()
    {
        view('auth.forgot');
    }

    public function forgot()
    {
        
        if (Session::get('forgot.time') != false && Session::get('forgot.time') > time()) {
            error("forgot", "wait 2 min and try again");
            return back();
        } else {
            Session::set("forgot.time", time() + 120);
            $request = new ForgotRequest();
            $inputs = $request->all();

            $user = User::where('email', $inputs['email'])->get();
            if (empty($user)) {
                error("forgot", "user not exists");
                return back();
            }
            
            $user = $user[0];
            $user->remember_token = generateToken();
            $user->remember_token_expire = date("Y-m-d H:i:s", strtotime(" + 10 min"));
            $user->save();
            $message = '
            <h2>ایمیل بازیابی رمز عبور </h2>
            <p>کاربر گرامی برای بازیابی رمز عبور خود از لینک زیر استفاده نمایید/p>
            <p style="text-align: center">
            <a href="' . route('auth.reset-password.view', [$user->remember_token]) . '">بازیابی رمز عبور</a>
            </p>
            ';
            $mailService = new MailService();
            $mailService->send($inputs['email'], 'ایمیل بازیابی رمز عبور', $message);
            flash('forgot', 'ایمیل بازیابی با موفقیت ارسال شد');
           
            return redirect($this->redirectTo);
        }
    }
}
