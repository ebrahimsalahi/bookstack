<?php

namespace App\Http\Controllers;

use App\Audit;
use App\Image;
use App\RoleUser;
use App\Shelf;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Facades\Validator;
use DataTables;
use App\RolePermit;
use Illuminate\Support\Facades\Gate;
use morilog\jalalijdate;

class ShelfController extends Controller
{

    public function index()
    {
        $menu = "shelves";
        $shelves = Shelf::orderBy('id', 'DESC')->paginate(5);
        return view('panel.shelves.index', compact('shelves', 'menu'));
    }

    public function list(Request $request)
    {

        if ($request->ajax()) {

            $data = Shelf::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    return jdate($row->created_at)->format('%A, %d %B %Y,%H:%M');
                })
                ->addColumn('name', function ($row) {
                    return "<a target='_blank' href='" . route('showshelf', $row->slug) . "'>" . $row->name . "</a>";
                })
                ->addColumn('books', function ($row) {
                    return $row->books->count();
                })
                ->addColumn('created_by', function ($row) {
                    return $row->user->name ;
                })
                ->addColumn('action', function ($row) {
                    $result = "";
                    if (Gate::check('check', 'shelves_edit')) {
                        $route = route('editShelf', $row->id);
                        $result .= "<a href=\"$route\" class=\"btn btn-success btn-sm\" ><i class=\"fa fa-edit\"></i> ویرایش </a>";
                    }

                    if (Gate::check('check', 'shelves_delete')) {
                        $route = route('deleteShelf', $row->id);
                        $result .= "<a href=\"$route\" onclick=\"return confirm('آیا از حذف این مورد اطمینان دارید ؟');\" class=\"btn btn-danger btn-sm mr-2\" ><i class=\"fa fa-trash\"></i> حذف </a>";

                    }
                    return $result;

                })
                ->rawColumns(['action', 'books', 'created_by', 'name'])
                ->make(true);
        }
    }

    public function create()
    {
        $menu = "shelves";
        return view('panel.shelves.create', compact('menu'));
    }

    public function store(Request $request)
    {

        $messagess = [
            'name.required' => 'لطفا نام قفسه را وارد کنید',
            'name.unique' => 'نام قفسه از قبل در سایت وجود دارد',
            'name.min' => 'نام قفسه خیلی کوتاه است',
            'name.max' => 'نام قفسه نمی تواند طولانی باشد',
            'description.required' => 'لطفا توضیحات را وارد کنید ',
            'description.min' => ' توضیحات خیلی کوتاه است  ',
            'description.max' => 'توضیحات  نمی تواند طولانی باشد',
            'file.required' => 'لطفا یک عکس انتخاب کنید',
            'file.mimes' => 'پسوند عکس انتخابی قاب قبول نمی باشد',
            'file.max' => 'حجم هکس انتخابی زیاد است',
        ];


        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:bookshelves|max:255|min:5',
            'description' => 'required|max:255|min:10',
            'file' => 'required|mimes:jpeg,jpg,png|max:100000',
        ], $messagess);


        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        }


        try {
            //code...

            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('files/shelves/'), $fileName);

            if ($request->file() != null) {

                $image = new Image();
                $image->name = $fileName;
                $image->save();

                $shelf = new Shelf();
                $shelf->name = $request->name;
                $shelf->description = $request->description;
                $shelf->created_by = $request->user()->id;
                $shelf->image_id = $image->id;
                $shelf->slug = \Str::slug($request->name);
                $shelf->save();

            }
            Audit::create([
                'event' => "ایجاد قفسه-" . $shelf->id,
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['success' => 'قفسه با موفقیت ایجاد شد', 'url' => '/usercp/shelves']);


        } catch (ٍException $exception) {
            return response()->json(['error' => 'خطا در سیستم ، لطفا دوباره امتحان کنید']);

        }

    }

    public function show($shelf)
    {
        $shelf = Shelf::where('slug', $shelf)->first();
        $updated_shelves = Shelf::orderBy('updated_at', 'DESC')->limit(10)->get();
        return view('theme.shelf', compact('shelf', 'updated_shelves'));

    }


    public function edit(Shelf $shelf)
    {
        $menu = "shelves";
        $description = RolePermit::where('name', '=', 'shelves_add')->first();
        return view('panel.shelves.edit', compact('shelf', 'menu', 'description'));
    }


    public function update(Request $request, Shelf $shelf)
    {

        $messagess = [
            'name.required' => 'لطفا نام قفسه را وارد کنید',
            'name.unique' => 'نام قفسه از قبل در سایت وجود دارد',
            'name.min' => 'نام قفسه خیلی کوتاه است',
            'name.max' => 'نام قفسه نمی تواند طولانی باشد',
            'description.required' => 'لطفا توضیحات را وارد کنید ',
            'description.min' => ' توضیحات خیلی کوتاه است  ',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:bookshelves,id,' . $shelf->name,
            'description' => 'required|max:255|min:10',


        ], $messagess);


        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        }


        if ($request->hasFile('file')) {
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('files/shelves/'), $fileName);
            $image = new Image();
            $image->name = $fileName;
            $image->save();
            Shelf::where('id', $shelf->id)->update(['image_id' => $image->id]);
        }


        $shelf->name = $request->name;
        $shelf->description = $request->description;
        $shelf->slug = \Str::slug($request->name);


        try {
            $shelf->save();
            Audit::create([
                'event' => "ویرایش قفسه-" . $shelf->id,
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['success' => 'ویرایش با موفقیت انجام شد', 'url' => '/usercp/shelves']);
        } catch (Exception $ex) {
            return response()->json(['error' => 'خطا در سیستم ، لطفا دوباره امتحان کنید']);
        }


    }


    public function destroy(Shelf $shelf)
    {
        try {
            $shelf->delete();
        } catch (Exception $exception) {
            return redirect(route('shelves'))->with('warning', $exception->getCode());
        }
        Audit::create([
            'event' => "حذف قفسه-" . $shelf->id,
            'user_id' => auth()->user()->id,
        ]);
        $msg = "آیتم مورد نظر حذف گردید";
        return redirect(route('shelves'))->with('success', $msg);
    }

}
