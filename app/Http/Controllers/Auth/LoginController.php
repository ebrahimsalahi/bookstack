<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/usercp';

    protected function redirectTo(Request $request)
    {

        $notification = array(
            'message' => 'خوش آمدید' . auth()->user()->name,
            'alert_type' => 'success'
        );
        return Redirect::route($this->redirectTo)->with('notification', $notification);

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function check(Request $request)
    {
        $user = $request->email;
        $pass = $request->password;


        $messagess = [
            'email.required' => 'لطفا نام کاربری را وارد کنید.',
            'email.exists' => 'نام کاربری در سایت یافت نشد',
            'password.required' => 'لطفا رمز عبور را وارد کنید',
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users',
            'password' => 'required'
        ], $messagess);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        } else {

            if (auth()->attempt(array('email' => $user, 'password' => $pass,'is_active'=>0))) {
                Auth::logout();
                return response()->json(['error' => 'کاربر   مسدود شده است']);
            }else{

                if (auth()->attempt(array('email' => $user, 'password' => $pass,'is_active'=>1) ,1)) {
                    return response()->json(['success' => 'با موفقیت وارد شدید','url'=>$this->redirectTo]);
                }
                else {
                    return response()->json(['error' => 'اطلاعات وارد شده در سایت وجود ندارد']);
                }

            }




        }


    }




    public function ShowLoginForm()
    {
        return view('panel.auth.login');
    }


}
