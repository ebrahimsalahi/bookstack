<?php

namespace App\Http\Controllers;

use App\Audit;
use App\RolePermit;
use Illuminate\Http\Request;
use App\Page;
use App\Book;
use App\Chapter;
use DataTables;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
class PageController extends Controller
{

    public function index()
    {
        $menu = "pages";
        $pages = Page::orderBy('id', 'DESC')->paginate(5);
        return view('panel.pages.index', compact('pages', 'menu'));
    }

    public function list(Request $request)
    {

        if ($request->ajax()) {

            $data = Page::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    return jdate($row->created_at)->format('%A, %d %B %Y,%H:%M');
                })

                ->addColumn('name', function ($row) {
                    $route = route('showpage', $row->slug);
                    return "<a target='_blank' href=\"$route\">{$row->name}</a>";
                })
                ->addColumn('book', function ($row) {
                    $route = route('showbook', $row->book->slug);
                    return "<a target='_blank' href=\"$route\">{$row->book->name}</a>";
                })
                ->addColumn('chapter', function ($row) {
                    $route = route('showchapter', $row->chapter->slug);
                    return "<a target='_blank' href=\"$route\">{$row->chapter->name}</a>";
                })
                ->addColumn('status', function($row){
                    if($row->status == 1)
                        return '<p class="text-primary">منتشرشده</p>';
                    return '<p class="text-danger">پیش نویس</p';
                })
                ->addColumn('action', function ($row) {

                    $result = "";
                    if (Gate::check('check', 'pages_edit')) {
                        $route = route('editPage', $row->id);
                        $result .= "<a href=\"$route\" class=\"btn btn-success btn-sm mr-2\" ><i class=\"fa fa-edit\"></i> ویرایش </a>";
                    }

                    if (Gate::check('check', 'pages_edit')) {
                        $route = route('deletePage', $row->id);
                        $result .= "<a href=\"$route\" onclick=\"return confirm('آیا از حذف این مورد اطمینان دارید ؟');\" class=\"btn btn-danger btn-sm mr-2\" ><i class=\"fa fa-trash\"></i> حذف </a>";

                    }
                    return $result;

                })
                ->rawColumns(['action','book','chapter','name','status'])
                ->make(true);
        }
    }

    public function create()
    {
        $menu = "pages";
        $books = Book::orderBy('name', 'DESC')->get();
        $chapters = Chapter::orderBy('name', 'DESC')->get();
        return view('panel.pages.create', compact('menu', 'books', 'chapters'));
    }

    public function store(Request $request)
    {

        $messagess = [
            'name.required' => 'لطفا نام صفحه را وارد کنید',
            'name.min' => 'نام صفحه خیلی کوتاه است',
            'name.max' => 'نام صفحه نمی تواند طولانی باشد',
            'book_id.required' => 'لطفا یک کتاب انتخاب کنید',
            'book_id.exists' => 'کتاب انتخابی شما وجود ندارد',
            'chapter_id.required' => 'لطفا یک فصل انتخاب کنید',
            'chapter_id.exists' => 'فصل انتخابی شما وجود ندارد',

        ];


        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|min:3',
            'text' => 'required|max:30000',
            'book_id' => 'required|exists:books,id',
            'chapter_id' => 'required|exists:chapters,id',
        ], $messagess);




        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        }

        $status = 1;
        if ($request->status == "on") $status = 0;

        try {

            $page = new Page();
            $page->book_id = $request->book_id;
            $page->chapter_id = $request->chapter_id;
            $page->name = $request->name;
            $page->status = $status;
            $page->text = $request->text;
            $page->slug = \Str::slug($request->name);
            $page->save();

            Audit::create([
                'event' => "ایجاد صفحه-" . $page->id,
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['success' => 'صفحه با موفقیت ایجاد شد', 'url' => '/usercp/pages']);

        } catch (ٍException $exception) {
            return response()->json(['error' => 'خطا در سیستم ، لطفا دوباره امتحان کنید']);

        }




    }

    public function show($slug)
    {
        $page = Page::where('slug', $slug)->first();
        $nextPage = Page::where('chapter_id', $page->chapter_id)->where('id', '>', $page->id)->first();
        $prevPage = Page::where('chapter_id', $page->chapter_id)->where('id', '<', $page->id)->first();
        if (empty($nextPage)) {
            $nextPage = "";
        }
        if (empty($prevPage)) {
            $prevPage = "";
        }
        return view('theme.page', compact('page', 'nextPage', 'prevPage'));
    }


    public function edit(Page $page)
    {
        $menu = "pages";
        $books = Book::orderBy('name', 'DESC')->get();
        $chapters = Chapter::orderBy('name', 'DESC')->get();
        $shelves = Chapter::orderBy('name', 'DESC')->get();

        return view('panel.pages.edit', compact('page', 'menu', 'books', 'chapters','shelves'));
    }


    public function update(Request $request, Page $page)
    {


        $messagess = [
            'name.required' => 'لطفا نام صفحه را وارد کنید',
            'name.min' => 'نام صفحه خیلی کوتاه است',
            'name.max' => 'نام صفحه نمی تواند طولانی باشد',
            'book_id.required' => 'لطفا یک کتاب انتخاب کنید',
            'book_id.exists' => 'کتاب انتخابی شما وجود ندارد',
            'chapter_id.required' => 'لطفا یک فصل انتخاب کنید',
            'chapter_id.exists' => 'فصل انتخابی شما وجود ندارد',

        ];


        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|min:3',
            'text' => 'required|max:30000',
            'book_id' => 'required|exists:books,id',
            'chapter_id' => 'required|exists:chapters,id',
        ], $messagess);




        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        }

        $status = 1;
        if ($request->status == "on") $status = 0;


        $page->name = $request->name;
        $page->text = $request->text;
        $page->book_id = $request->book_id;
        $page->chapter_id = $request->chapter_id;
        $page->slug = \Str::slug($request->slug);


        try {
            $page->save();
            Audit::create([
                'event' => "ویرایش صفحه-" . $page->id,
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['success' => 'صفحه با موفقیت ویرایش شد', 'url' => '/usercp/pages']);

        } catch (ٍException $exception) {
            return response()->json(['error' => 'خطا در سیستم ، لطفا دوباره امتحان کنید']);

        }

    }

    public function destroy(Page $page)
    {

        try {
            $page->delete();
            Audit::create([
                'event' => "حذف صفحه-" . $page->id,
                'user_id' => auth()->user()->id,
            ]);
        } catch (Exception $exception) {
            return redirect(route('pages'))->with('warning', $exception->getCode());
        }
        $msg = "آیتم مورد نظر حذف گردید";
        return redirect(route('pages'))->with('success', $msg);
    }
}
