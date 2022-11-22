<?php

namespace App\Http\Controllers;

use App\Audit;
use App\Province;
use App\RolePermit;
use App\User;
use App\Role;
use App\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Illuminate\Support\Facades\Gate;
use App\Education;

class UserController extends Controller
{


    public function index()
    {
        $menu = "users";
        $users = User::All();
        return view('panel.users.index', compact('users', 'menu'));
    }

    public function profile()
    {

        $user = auth()->user();
        $menu = "account";
        $educations = Education::All();
        $provinces = Province::All();
        return view('panel.profile.index', compact('user', 'menu', 'educations', 'provinces'));
    }

    public function create()
    {
        $menu = "users";
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('panel.users.create', compact('menu', 'roles'));
    }

    public function updateAccount(Request $request, User $user)
    {

        $messagess = [
            'name.required' => 'لطفا نام کاربر را وارد کنید',
            'email.required' => 'لطفا ایمیل کاربر را وارد کنید',
            'email.email' => 'لطفا یک ایمیل معتبر وارد کنید',
            'mobile.required' => 'لطفا موبایل کاربر را وارد کنید',
            'mobile.regex' => 'لطفا یک شماره موبایل معتبر وارد کنید',
            'password.required' => 'لطفا رمزعبور کاربر را وارد کنید',
            'password.min' => 'رمزعبور کاربر باید حداقل 8 کاراکتر باشد',
            'province_id.required'=>'استان خود را انتخاب کنید',
            'province_id.exists'=>'استان خود را انتخاب کنید',
            'edu_id.required'=>'سطح تحصیلی خود را انتخاب کنید',
            'edu_id.exists'=>'سطح تحصیلی خود را انتخاب کنید',
            'note.max'=>'یادداشت نمی تواند بیشتر از دوهزار کاراکتر باشد',

        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'mobile' => 'required|regex:/(09)[0-9]{9}/|digits:11|numeric',
            'province_id' => 'required|exists:provinces,id',
            'edu_id' => 'required|exists:educations,id',
            'note' => 'max:2000'
        ], $messagess);





        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        } else {

            if (!empty($request->password)) {

                $validator_pass = Validator::make($request->all(), [
                    'password' => 'required|min:8',
                ], $messagess);


                if ($validator_pass->fails()) {
                    return response()->json(['error' => $validator_pass->errors()->first()]);
                }

                $password = Hash::make($request->password);
                $user->password = $password;

            }


            Audit::create([
                'event' => "ویرایش حساب کاربری-" . $user->id,
                'user_id' => auth()->user()->id
            ]);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->province_id = $request->province_id;
            $user->edu_id = $request->edu_id;
            $user->skills = $request->skills;
            $user->about = $request->about;
            $user->note = $request->note;

            try {
                $user->save();
                Audit::create([
                    'event' => " ویرایش پروفایل-" . $user->id,
                    'user_id' => auth()->user()->id,
                ]);
                return response()->json(['success' => 'ویرایش با موفقیت انجام شد','url'=>'./account' ]);

            } catch (Exception $exception) {
                return response()->json(['error' => 'خطا در سیستم ، لطفا دوباره امتحان کنید']);
            }

        }
    }

    public function store(Request $request)
    {

        $messagess = [
            'name.required' => 'لطفا نام کاربر را وارد کنید',
            'email.required' => 'لطفا ایمیل کاربر را وارد کنید',
            'email.email' => 'لطفا یک ایمیل معتبر وارد کنید',
            'email.unique' => 'ایمیل وارد شده از قبل در سایت ثبت شده است',
            'mobile.required' => 'لطفا موبایل کاربر را وارد کنید',
            'mobile.unique' => 'موبایل وارد شده از قبل در سایت صبت شده است',
            'mobile.regex' => 'لطفا یک شماره موبایل معتبر وارد کنید',
            'mobile.digits' => 'لطفا یک شماره موبایل معتبر وارد کنید',
            'password.required' => 'لطفا رمزعبور کاربر را وارد کنید',
            'password.min' => 'رمزعبور کاربر باید حداقل 8 کاراکتر باشد',
            'role.exists' => 'نقش انتخاب شده در سایت وجود ندارد'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'mobile' => 'required|unique:users|regex:/(09)[0-9]{9}/|digits:11|numeric',
            'password' => 'required|min:8',
            'role' => 'exists:roles,id'
        ], $messagess);

        $is_active = 0;
        if ($request->is_active == "on") $is_active = 1;


        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        }


        try {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->is_active = $is_active;
            $user->password = bcrypt($request->password);
            $user->save();

            RoleUser::create([
                'role_id' => $request->role,
                'user_id' => $user->id
            ]);

            Audit::create([
                'event' => "ثبت کاربر جدید-" . $user->id,
                'user_id' => auth()->user()->id
            ]);

            return response()->json(['success' => 'ثبت کاربر با موفقیت انجام شد', 'url' => '/usercp/users']);


        } catch (Exception $exception) {
            return response()->json(['error' => 'خطا در سیستم ، لطفا دوباره امتحان کنید']);
        }


    }


    public function list(Request $request)
    {
       if ($request->ajax()) {

        $data = User::latest()->get();
        return Datatables::of($data)

            ->addIndexColumn()
            ->addColumn('created_at',function ($row){
                return jdate($row->created_at)->format('%A, %d %B %Y,%H:%M');
            })
            ->addColumn('role',function ($row){
                $users = User::all()->find($row->id)->roles()->first()->name;
                return '<p class="text-success">'.$users.'</p>';
            })
            ->addColumn('is_active', function($row){
                if($row->is_active == 1)
                    return '<p class="text-primary">فعال</p>';
                return '<p class="text-danger">مسدود</p';
            })
            ->addColumn('action', function($row){



                $result = "";

                    if (Gate::check('check','users_edit')) {
                        $route = route('editUser',$row->id) ;
                        $result .= "<a href=\"$route\" class=\"btn btn-success btn-sm\" ><i class=\"fa fa-edit\"></i> ویرایش </a>";
                    }
                if ($row->id != 1) {

                    if (Gate::check('check','users_delete')) {
                        $route = route('deleteUser',$row->id) ;
                        $result .= "<a href=\"$route\" onclick=\"return confirm('آیا از حذف این مورد اطمینان دارید ؟');\" class=\"btn btn-danger btn-sm mr-2\" ><i class=\"fa fa-trash\"></i> حذف </a>";

                    }
                }


                return $result;

            })
            ->rawColumns(['action','is_active','role'])
            ->make(true);
       }

    }
    public function edit(User $user)
    {

        $roles = Role::orderBy('id', 'DESC')->get();
        $menu = "users";
        return view('panel.users.edit', compact('user', 'menu', 'roles'));
    }


    public function update(Request $request, User $user)
    {
        //
        $messagess = [
            'name.required' => 'لطفا نام کاربر را وارد کنید',
            'email.required' => 'لطفا ایمیل کاربر را وارد کنید',
            'email.email' => 'لطفا یک ایمیل معتبر وارد کنید',
            'mobile.required' => 'لطفا موبایل کاربر را وارد کنید',
            'mobile.regex' => 'لطفا یک شماره موبایل معتبر وارد کنید',
            'password.required' => 'لطفا رمزعبور کاربر را وارد کنید',
            'password.min' => 'رمزعبور کاربر باید حداقل 8 کاراکتر باشد',
            'role.exists' => 'نقش انتخاب شده در سایت وجود ندارد'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|regex:/(09)[0-9]{9}/|digits:11|numeric',
            'role' => 'exists:roles,id'
        ], $messagess);


        $is_active = 0;
        if ($request->is_active == "on") $is_active = 1;


        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        } else {

            if (!empty($request->password)) {
                $validateData = $request->validate([
                    'password' => 'required|min:8',
                ], $messages);
                $password = hash::make($request->password);
                $user->password = $password;
            }


            RoleUser::where('user_id', $user->id)->delete();

            RoleUser::create([
                'role_id' => $request->role,
                'user_id' => $user->id
            ]);


            Audit::create([
                'event' => "ویرایش کاربر-" . $user->id,
                'user_id' => auth()->user()->id
            ]);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->is_active = $is_active;
            try {
                $user->save();
                return response()->json(['success' => 'ویرایش با موفقیت انجام شد', 'url' => '/usercp/users']);

            } catch (Exception $exception) {
                return response()->json(['error' => 'خطا در سیستم ، لطفا دوباره امتحان کنید']);
            }

        }


    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            Audit::create([
                'event' => " حذف کاربر-" . $user->id,
                'user_id' => auth()->user()->id
            ]);
        } catch (Exception $exception) {
            return redirect(route('users'))->with('warning', $exception->getCode());
        }

        $msg = "آیتم مورد نظر حذف گردید";
        return redirect(route('users'))->with('success', $msg);
    }
}
