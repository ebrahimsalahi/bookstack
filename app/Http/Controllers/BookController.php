<?php

namespace App\Http\Controllers;

use App\Audit;
use Illuminate\Http\Request;
use App\Book;
use App\Shelf;
use morilog\jalalijdate;
use Yajra\DataTables\DataTables;
use App\RolePermit;
use App\Image;
use App\user;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{

    public function index()
    {
        $menu = "books";
        $books = Book::orderBy('id', 'DESC')->paginate(5);
        return view('panel.books.index', compact('books', 'menu'));
    }

    public function list(Request $request)
    {

        if ($request->ajax()) {
        $data = Book::latest()->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('created_at', function ($row) {
                return jdate($row->created_at)->format('%A, %d %B %Y,%H:%M');
            })
            ->addColumn('action', function ($row) {

                $result = "";

                if (Gate::check('check', 'books_edit')) {
                    $route = route('editBook', $row->id);
                    $result .= "<a href=\"$route\" class=\"btn btn-success btn-sm mr-2\" ><i class=\"fa fa-edit\"></i> ویرایش </a>";
                }

                if (Gate::check('check', 'books_edit')) {
                    $route = route('deleteBook', $row->id);
                    $result .= "<a href=\"$route\" onclick=\"return confirm('آیا از حذف این مورد اطمینان دارید ؟');\" class=\"btn btn-danger btn-sm mr-2\" ><i class=\"fa fa-trash\"></i> حذف </a>";
                }
                return $result;

            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function create()
    {
        $menu = "books";
        $shelves = Shelf::orderBy('name', 'DESC')->get();
        return view('panel.books.create', compact('menu', 'shelves'));
    }

    public function store(Request $request)
    {
        $messagess = [
            'name.required' => 'لطفا نام کتاب را وارد کنید',
            'name.unique' => 'نام کتاب از قبل در سایت وجود دارد',
            'name.min' => 'نام کتاب خیلی کوتاه است',
            'name.max' => 'نام کتاب نمی تواند طولانی باشد',
            'description.required' => 'لطفا توضیحات را وارد کنید ',
            'description.min' => ' توضیحات خیلی کوتاه است  ',
            'description.max' => 'توضیحات  نمی تواند طولانی باشد',
            'file.required' => 'لطفا یک عکس انتخاب کنید',
            'file.mimes' => 'پسوند عکس انتخابی قاب قبول نمی باشد',
            'file.max' => 'حجم هکس انتخابی زیاد است',
            'shelf_id.required' => 'قفسه کتاب را انتخاب کنید',
            'shelf_id.exists' => 'قفسه کتاب وجود ندارد',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:books|max:255|min:5',
            'description' => 'required|max:255|min:10',
            'file' => 'required|mimes:jpeg,jpg,png|max:100000',
            'shelf_id' => 'required|exists:bookshelves,id',
        ], $messagess);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        }

        try {

            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('files/books/'), $fileName);

            if ($request->file() != null) {

                $image = new Image();
                $image->name = $fileName;
                $image->save();

                $book = new Book();
                $book->name = $request->name;
                $book->description = $request->description;
                $book->created_by = $request->user()->id;
                $book->image_id = $image->id;
                $book->shelf_id = $request->shelf_id;
                $book->slug = \Str::slug($request->name);
                $book->save();
                Audit::create([
                    'event' => "ایجاد کتاب-" . $book->id,
                    'user_id' => auth()->user()->id,
                ]);
            }

            return response()->json(['success' => 'کتاب با موفقیت ایجاد شد', 'url' => '/usercp/books']);


        } catch (ٍException $exception) {
            return response()->json(['error' => 'خطا در سیستم ، لطفا دوباره امتحان کنید']);

        }


    }

    public function showAll()
    {
        $shelves = Shelf::orderBy('name', 'DESC')->get();
        return view('theme.books', compact('shelves'));
    }

    public function show($slug)
    {

        $book = Book::where('slug', $slug)->first();
        $last_books = Book::orderBy('created_at','desc')->limit(10)->get();
        if (is_null($book)) {
            return abort(404);
        } else {
            $book->incrementViewCount();
            return view('theme.book', compact('book','last_books'));
        }

    }

    public function edit(Book $book)
    {
        $menu = "books";
        $shelves = Shelf::orderBy('name', 'DESC')->get();
        return view('panel.books.edit', compact('book', 'menu', 'shelves'));
    }


    public function update(Request $request, Book $book)
    {

        $messagess = [
            'name.required' => 'لطفا نام کتاب را وارد کنید',
            'name.unique' => 'نام کتاب از قبل در سایت وجود دارد',
            'name.min' => 'نام کتاب خیلی کوتاه است',
            'name.max' => 'نام کتاب نمی تواند طولانی باشد',
            'description.required' => 'لطفا توضیحات را وارد کنید ',
            'description.min' => ' توضیحات خیلی کوتاه است  ',
            'shelf_id.required' => 'قفسه کتاب را انتخاب کنید',
            'shelf_id.exists' => 'قفسه کتاب وجود ندارد',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:books,id,' . $book->name,
            'description' => 'required|max:255|min:10',
            'shelf_id' => 'required|exists:bookshelves,id',
        ], $messagess);


        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        }


        if ($request->hasFile('file')) {
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('files/books/'), $fileName);
            $image = new Image();
            $image->name = $fileName;
            $image->save();
            Image::where('id',$book->image_id)->delete(['id'=>$book->image_id]);
            Shelf::where('id',$shelf->id)->update(['image_id'=>$image->id]);
        }


        $book->name = $request->name;
        $book->shelf_id = $request->shelf_id;
        $book->description = $request->description;
        $book->slug = \Str::slug($request->name);

        try {
            $book->save();
            Audit::create([
                'event' => "ویرایش کتاب-" . $book->id,
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['success' => 'ویرایش با موفقیت انجام شد', 'url' => '/usercp/books']);

        } catch (Exception $ex) {
            return response()->json(['error' => 'خطا در سیستم ، لطفا دوباره امتحان کنید']);
        }

    }

    public function destroy(Book $book)
    {

        try {
            $book->delete();
            Audit::create([
                'event' => "حذف کتاب-" . $book->id,
                'user_id' => auth()->user()->id,
            ]);
        } catch (Exception $exception) {
            return redirect(route('books'))->with('warning', $exception->getCode());
        }

        $msg = "آیتم مورد نظر حذف گردید";
        return redirect(route('books'))->with('success', $msg);
    }
}
