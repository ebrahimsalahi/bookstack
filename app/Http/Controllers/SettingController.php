<?php

namespace App\Http\Controllers;

use App\Book;
use App\RolePermit;
use Illuminate\Http\Request;
use App\Setting;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{

    public function show(Setting $setting)
    {
        $setting = Setting::first();
        $description = RolePermit::where('name', '=', 'Settings')->first();
        $menu = "setting";
        return view('panel.setting', compact('setting', 'description', 'menu'));
    }

    public function rules(Setting $setting)
    {
        $setting = Setting::first();
        $last_books = Book::orderBy('created_at', 'desc')->limit(10)->get();
        return view('theme.rules', compact('setting', 'last_books'));
    }

    public function about(Setting $setting)
    {
        $setting = Setting::first();
        $last_books = Book::orderBy('created_at', 'desc')->limit(10)->get();
        return view('theme.about', compact('setting', 'last_books'));
    }

    public function update(Request $request)
    {
        $setting = Setting::first();


        $messagess = [
            'title.required' => 'عنوان سایت را وارد کنید',
            'title.max' => 'عنوان نمی تواند طولانی باشد',
            'email.required' => ' ایمیل سایت را وارد کنید',
            'email.email' => 'لطفا یک ایمیل معتبر وارد کنید',
            'rules.required' => 'متن  قوانین و مقررات را وارد کنید',
            'phone.required' => 'تلفن سایت را وارد کنید ',
            'phone.max' => ' تلفن سایت نمی تواند طولانی باشد ',
            'about.required' => 'متن درباره ما را وارد کنید',
            'register.required' => 'وضعیت ثبت نام در سایت را انتخاب  کنید'
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'email' => 'required|email|max:255',
            'rules' => 'required|max:10000',
            'about' => 'required|max:10000',
            'phone' => 'required|max:255',
            'register_status' => 'required|boolean'

        ], $messagess);

        $setting->phone = $request->phone;
        $setting->email = $request->email;
        $setting->rules = $request->rules;
        $setting->about = $request->about;
        $setting->register_status = $request->register_status;
        $setting->title = $request->title;

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        } else {
            try {
                $setting->save();
                return response()->json(['success' => 'ویرایش با موفقیت انجام شد', 'url' => '/usercp/settings']);

            } catch (Exception $exception) {
                return response()->json(['error' => 'خطا در سیستم ، لطفا دوباره امتحان کنید']);
            }


        }



    }

}
