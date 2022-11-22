<?php

namespace App\Http\Controllers;

use App\Audit;
use App\RolePermit;
use Illuminate\Http\Request;
use App\Chapter;
use App\Book;
use DataTables;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class ChapterController extends Controller
{

    public function index()
    {
        $menu = "chapters";
        $chapters = Chapter::orderBy('id','DESC')->paginate(5);
        return view('panel.chapters.index',compact('chapters','menu'));
    }

    public function create()
    {
        $menu = "chapters";
        $books = Book::orderBy('name','DESC')->get();
        $description = RolePermit::where('name', '=', 'chapters_add')->first();
        return view('panel.chapters.create',compact('menu','books','description'));
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {

            $data = Chapter::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('created_at',function ($row){
                    return jdate($row->created_at)->format('%A, %d %B %Y,%H:%M');
                })

                ->addColumn('status', function($row){
                    if($row->status == 1)
                        return '<p class="text-primary">منتشرشده</p>';
                    return '<p class="text-danger">پیش نویس</p';
                })
                ->addColumn('action', function($row){
                    $result = "";
                    if (Gate::check('check','chapters_edit')) {
                        $route = route('editChapter',$row->id) ;
                        $result .= "<a href=\"$route\" class=\"btn btn-success btn-sm\" ><i class=\"fa fa-edit\"></i>ویرایش </a>";
                    }
                    if (Gate::check('check','chapters_delete')) {
                        $route = route('deleteChapter',$row->id) ;
                        $result .= "<a href=\"$route\" onclick=\"return confirm('آیا از حذف این مورد اطمینان دارید ؟');\" class=\"btn btn-danger btn-sm mr-2\" ><i class=\"fa fa-trash\"></i> حذف </a>";

                    }
                    return $result;

                })
                ->rawColumns(['action','status'])
                ->make(true);
        }

    }

    public function store(Request $request)
    {

        $messagess = [
            'name.required' => 'لطفا نام فصل را وارد کنید',
            'name.min' => 'نام فصل خیلی کوتاه است',
            'name.max' => 'نام فصل نمی تواند طولانی باشد',
            'description.required' => 'لطفا توضیحات را وارد کنید ',
            'description.min' => ' توضیحات خیلی کوتاه است  ',
            'description.max' => 'توضیحات  نمی تواند طولانی باشد',
            'book_id.required' => 'لطفا یک کتاب انتخاب کنید',
            'book_id.exists' => 'کتاب انتخابی شما وجود ندارد'
        ];


        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|min:3',
            'description' => 'required|max:255|min:10',
            'book_id' => 'required|exists:books,id',
        ], $messagess);


        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        }

        $status = 1;
        if ($request->status == "on") $status = 0;

        try {

            $chapter = new Chapter();
            $chapter->book_id = $request->book_id;
            $chapter->name = $request->name;
            $chapter->status = $status;
            $chapter->description = $request->description;
            $chapter->slug = \Str::slug($request->name);
            $chapter->save();

            Audit::create([
                'event' => "ایجاد فصل-" . $chapter->id,
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['success' => 'فصل با موفقیت ایجاد شد', 'url' => '/usercp/chapters']);

        } catch (ٍException $exception) {
            return response()->json(['error' => 'خطا در سیستم ، لطفا دوباره امتحان کنید']);

        }



    }


    public function show($slug)
    {
        $chapter = Chapter::where('slug',$slug)->first();
        return view('theme.chapter',compact('chapter'));
    }

    public function edit(Chapter $chapter)
    {
        $menu = "chapters";
        $books = Book::orderBy('name','DESC')->get();
        $description = RolePermit::where('name', '=', 'chapters_edit')->first();
        return view('panel.chapters.edit',compact('chapter','menu','books','description'));
    }


    public function update(Request $request,Chapter $chapter)
    {



        $messagess = [
            'name.required' => 'لطفا نام فصل را وارد کنید',
            'name.min' => 'نام فصل خیلی کوتاه است',
            'name.max' => 'نام فصل نمی تواند طولانی باشد',
            'description.required' => 'لطفا توضیحات را وارد کنید ',
            'description.min' => ' توضیحات خیلی کوتاه است  ',
            'description.max' => 'توضیحات  نمی تواند طولانی باشد',
            'book_id.required' => 'لطفا یک فصل انتخاب کنید',
            'book_id.exists' => 'کتاب انتخابی شما وجود ندارد'
        ];


        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|min:3',
            'description' => 'required|max:255|min:10',
            'book_id' => 'required|exists:books,id',
        ], $messagess);


        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        }

        $status = 1;
        if ($request->status == "on") $status = 0;


        $chapter->name = $request->name;
        $chapter->description = $request->description;
        $chapter->book_id = $request->book_id;
        $chapter->status = $status;
        $chapter->slug = \Str::slug($request->name);


        try {
            $chapter->save();
            Audit::create([
                'event' => "ویرایش فصل-" . $chapter->id,
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['success' => 'فصل با موفقیت ویرایش شد', 'url' => '/usercp/chapters']);

        } catch (ٍException $exception) {
            return response()->json(['error' => 'خطا در سیستم ، لطفا دوباره امتحان کنید']);
        }

    }

    public function destroy(Chapter $chapter)
    {

        try {
            $chapter->delete();
            Audit::create([
                'event' => "حذف فصل-" . $chapter->id,
                'user_id' => auth()->user()->id,
            ]);
        } catch (Exception $exception) {
            return redirect(route('chapters'))->with('warning', $exception->getCode());
        }
        $msg = "آیتم مورد نظر حذف گردید";
        return redirect(route('chapters'))->with('success', $msg);
    }
}
