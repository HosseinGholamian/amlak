<?php

namespace App\Http\Controllers\Auth;


use App\Http\Requests\Auth\RegisterRequest;
use App\User;
use App\Http\Services\ImageUpload;
use App\Http\Services\MailService;

class RegisterController
{
    private $redirectTo = '/login';

    public function view()
    {
        view('auth.register');
    }

    public function register()
    {
        $request = new RegisterRequest();
        $inputs = $request->all();




        $inputs['is_active'] = 0;
        $inputs['user_type'] = "user";
        $inputs['status'] = 0;
        $inputs["verify_token"] = generateToken();
        $inputs['remember_token'] = null;
        $inputs['remember_token_expire	'] = null;

        $path = 'images/users/' . date('Y/M/d');
        $name = date('Y_M_d_H_i_s') . "_" . rand(10, 99);
        $inputs['avatar'] = ImageUpload::UploadAndFitImage($request->file('avatar'), $path, $name, 100, 100);

        $inputs['password'] = password_hash($request->password, PASSWORD_DEFAULT);

        User::create($inputs);


        $message = '
        <h1> فعال سازی حساب کاربری </h1>
        <p>کاربر گرامی ثبت نام شما با موفقیت انجام شد لطفا برای فعال سازی حساب کاربری روی لینک زیر کلیک کنید</p>
        <p>
        <a href="' . route('auth.activation', [$inputs['verify_token']]) . '"  >لینک فعال سازی</a>
        </p>
        ';

        $mailService = new MailService();
        $mailService->send($inputs['email'], 'ایمیل فعال سازی', $message);

        return redirect($this->redirectTo);
    }


    public function activation($token)
    {
        $user = User::where('verify_token', $token)->get();


        if (empty($user)) {
            die('کد فعال سازی اشتباه است');
        }

        
        $user = $user[0];
        $user->is_active = 1;
        $user->save();

        die('حساب شما فعال شد');
    }
}
