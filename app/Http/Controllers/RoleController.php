<?php

namespace App\Http\Controllers;

use App\Audit;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\RolePermit;
use App\PermitRole;
use App\RoleUser;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\Jalalian;
use DataTables;
class RoleController extends Controller
{

    public function index()
    {
        $menu = "roles";
        $roles = Role::orderBy('id','ASC')->paginate(20);

        return view('panel.roles.index',compact('roles','menu'));
    }

    public function list(Request $request)
    {

        if ($request->ajax()) {

            $data = Role::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    return jdate($row->created_at)->format('%A, %d %B %Y,%H:%M');
                })
                ->addColumn('count_user', function ($row) {
                    return $row->users->count();
                    $route = route('showbook', $row->book->slug);
                    return "<a target='_blank' href=\"$route\">{$row->book->name}</a>";
                })

                ->addColumn('action', function ($row) {
                    $result = "";
                    /*بزرگتر از دو نقش پیش فرض*/

                        if (Gate::check('check', 'roles_edit')) {
                            $route = route('editRole', $row->id);
                            $result .= "<a href=\"$route\" class=\"btn btn-success btn-sm mr-2\" ><i class=\"fa fa-edit\"></i> ویرایش </a>";
                        }
                    if($row->id > 2){

                        if (Gate::check('check', 'roles_delete', $row->id)){
                            $route = route('deleteRole', $row->id);
                            $result .= "<a href=\"$route\" onclick=\"return confirm('آیا از حذف این مورد اطمینان دارید ؟');\" class=\"btn btn-danger btn-sm mr-2\" ><i class=\"fa fa-trash\"></i> حذف </a>";
                        }
                    }
                    return $result;

                })
                ->rawColumns(['action','count_user','chapter','name','status'])
                ->make(true);
        }
    }



    public function create()
    {
        $menu = "menu";
        $rolePermit = RolePermit::orderBy('name','DESC')->get();
        $description = RolePermit::where('name', '=', 'roles_add')->first();
        return view('panel.roles.create',compact('menu','rolePermit'));
    }



    public function store(Request $request)
    {
        $messagess = [
            'name.required' => 'لطفا نام نقش را وارد کنید',
            'name.unique' => 'نام کتاب از نقش در سایت وجود دارد',
            'name.min' => 'نام نقش خیلی کوتاه است',
            'name.max' => 'نام نقش نمی تواند طولانی باشد',
            'description.required' => 'لطفا توضیحات را وارد کنید ',
            'description.min' => ' توضیحات خیلی کوتاه است  ',
            'description.max' => 'توضیحات  نمی تواند طولانی باشد',
        ];
        $request->name = strtolower($request->name);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles',
            'description' => 'required|max:255|min:10'
        ], $messagess);



        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        }


        if(empty($request->permissions)){
            return response()->json(['error' => 'حداقل یک دسترسی برای نقش باید اانتخاب گردد' ]);
        }

        $rolePermit = RolePermit::All();
        $permissions = $request->permissions;

        foreach ($permissions as $val) {
            $permit = RolePermit::where('id', '=', $val )->first();
            if ($permit === null) {
                return response()->json(['error' => 'دسترسی های انتخاب شده وجود ندارد']);
            }
        }

        $role = new Role();
        $role->name = $request->name;
        $role->description = $request->description;


        try {

            $role->save();
            foreach ($permissions as $val) {
                $PermitRole = new PermitRole();
                $PermitRole->permission_id = $val;
                $PermitRole->role_id = $role->id;
                $PermitRole->save();
            }
            Audit::create([
                'event' => "ایجاد نقش-" . $role->id,
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['success' => 'نقش جدید با موفقیت ایجاد شد','url'=>'/usercp/roles']);
        } catch (Exception $ex) {
            return response()->json(['error' => 'خطا در سیستم ، لطفا دوباره امتحان کنید']);

        }

    }

    public function edit(Request $request,Role $role )
    {

        $menu = "roles";
        $rolePermit = RolePermit::orderBy('name','DESC')->get();
        $role_permissions = PermitRole::where('role_id','=',$role->id)->get();
        return view('panel.roles.edit',compact('rolePermit','role','menu','role_permissions'));
    }

    public function update(Request $request, Role $role)
    {

        $messagess = [
            'name.required' => 'لطفا نام نقش را وارد کنید',
            'name.unique' => 'نام کتاب از نقش در سایت وجود دارد',
            'name.min' => 'نام نقش خیلی کوتاه است',
            'name.max' => 'نام نقش نمی تواند طولانی باشد',
            'description.required' => 'لطفا توضیحات را وارد کنید ',
            'description.min' => ' توضیحات خیلی کوتاه است  ',
            'description.max' => 'توضیحات  نمی تواند طولانی باشد',
        ];
        $request->name = strtolower($request->name);

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,id',$role->name,
            'description' => 'required|max:255|min:10'
        ], $messagess);


        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        }

        if(empty($request->permissions)){
            return response()->json(['error' => 'حداقل یک دسترسی برای نقش باید اانتخاب گردد' ]);
        }

        $rolePermit = RolePermit::All();
        $permissions = $request->permissions;

        foreach ($permissions as $val) {
            $permit = RolePermit::where('id', '=', $val )->first();
            if ($permit === null) {
                return response()->json(['error' => 'دسترسی های انتخاب شده وجود ندارد']);
            }
        }


        $role->name = $request->name;
        $role->description = $request->description;




        try {


            $role->save();

            PermitRole::where('role_id',$role->id)->delete();
            foreach ($permissions as $val) {
                $PermitRole = new PermitRole();
                $PermitRole->permission_id = $val;
                $PermitRole->role_id = $role->id;
                $PermitRole->save();
            }


            Audit::create([
                'event' => "ویرایش نقش-" . $role->id,
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['success' => 'نقش با موفقیت ویرایش شد','url'=>'/usercp/roles']);

        } catch (Exception $ex) {
            return response()->json(['error' => 'خطا در سیستم ، لطفا دوباره امتحان کنید']);
        }





    }

    public function destroy(Role $role)
    {
        try {
            $role->delete();
            Audit::create([
                'event' => "حذف نقش-" . $role->id,
                'user_id' => auth()->user()->id,
            ]);
        } catch (Exception $exception) {
            return redirect(route('roles'))->with('warning', $exception->getCode());
        }

        $msg = "آیتم مورد نظر حذف گردید";
        return redirect(route('roles'))->with('success', $msg);
    }
}
