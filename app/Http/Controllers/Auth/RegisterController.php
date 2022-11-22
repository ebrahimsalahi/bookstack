<?php

namespace App\Http\Controllers\Auth;

use App\Audit;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\RoleUser;
use App\Setting;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/usercp/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showRegistrationForm()
    {
        return view('panel.auth.register');
    }

    public function check(Request $request)
    {

        $setting = Setting::first();

        if ($setting->register_status == 0) {
            return response()->json(['error' => 'ثبت نام در سایت محدود شده است ، مدتی دیگرامتحان کنید']);
        }


        $request = $request->all();
        $request['email'] = strtolower($request['email']);
        $messagess = [
            'name.required' => 'لطفا نام خود را وارد کنید.',
            'email.required' => 'ایمیل خود را وارد کنید',
            'email.email' => 'لطفا یک ایمیل معتبر وارد کنید',
            'email.exists' => 'ایمیل وارد شده از قبل در سایت وجود دارد',
            'email.unique' => 'ایمیل وارد شده از قبل در سایت وجود دارد',
            'mobile.regex' => 'لطفا یک شماره موبایل معتبر وارد کنید',
            'password.required' => 'لطفا رمز عبور را وارد کنید',
            'password.min' => 'رمزعبور حداقل 8 کاراکتر باید باشد',
            'password.confirmed' => 'تکرار رمزعبور با رمز عبور برابر نیست',
            'password_confirmation.confirmed' => 'تکرار رمزعبور را وارد کنید'
        ];
        $validator = Validator::make($request, [
            'name' => 'required|max:255|min:3',
            'email' => 'required|max:255|unique:users|email',
            'mobile' => 'required|regex:/(09)[0-9]{9}/|digits:11|numeric|unique:users',
            'password' => 'required|min:8|confirmed|max:10000',
            'password_confirmation' => 'required',

        ], $messagess);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        } else {

            $newUser = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'mobile' => $request['mobile'],
                'password' => Hash::make($request['password']),
            ]);


            if (!$newUser) {
                return response()->json(['error' => 'خطا در سیستم ، لطفا دوباره امتحان کنید']);
            }else{
                RoleUser::create([
                    'role_id' => 2,
                    'user_id' => $newUser->id
                ]);

                Audit::create([
                    'event' => "ثبت نام کاربر  " . $newUser->id,
                    'user_id' => $newUser->id,
                ]);

                return response()->json(['success' => 'ثبت نام شما با موفقیت انجام شد','url'=>$this->redirectTo]);

            }


        }



    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }


}
