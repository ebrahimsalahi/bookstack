<?php

namespace App\Http\Controllers;

use App\Audit;
use App\BookComment;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookCommentController extends Controller
{

    public function index()
    {
        $menu = "comments";
        $comments = BookComment::orderBy('status', 'ASC')->paginate(5);
        return view('panel.comments.index', compact('comments', 'menu'));
    }

    public function list()
    {
        $menu = "pages";
        $pages = Page::orderBy('id', 'DESC')->paginate(5);
        return view('panel.pages.index', compact('pages', 'menu'));
    }

    public function destroy(BookComment $comment)
    {
        try {
            $comment->delete();
            Audit::create([
                'event' => "  حذف نظر-" . $comment->id,
                'user_id' => auth()->user()->id,
            ]);
        } catch (Exception $exception) {
            return redirect(route('comments'))->with('warning', $exception->getCode());
        }

        $msg = "آیتم مورد نظر حذف گردید";
        return redirect(route('comments'))->with('success', $msg);
    }

    public function unverify(BookComment $comment)
    {
        $comment->status = 0;
        $comment->save();
        Audit::create([
            'event' => " عدم تایید نظر-" . $comment->id,
            'user_id' => auth()->user()->id,
        ]);

        $msg = "نظر به حالت تایید نشده تغییر کرد   ";
        return redirect(route('comments'))->with('success', $msg);
    }

    public function verify(BookComment $comment)
    {
        $comment->status = 1;
        $comment->save();
        Audit::create([
            'event' => " تایید نظر-" . $comment->id,
            'user_id' => auth()->user()->id,
        ]);
        $msg = "نظر با موفقیت تایید شد";
        return redirect(route('comments'))->with('success', $msg);
    }

    public function new(Request $request)
    {
        //
        $messagess = [
            'comment.required' => 'متن نظر خود وارد کنید',
            'comment.max' => 'متن نظر نمیتواند طولانی باشد',
            'user_id.exists' => 'چنین کاربری در سیستم یافت نشد',
            'book_id.exsists' => 'چنین کتابی در سیسیتم یافت نشد'
        ];

        $validator = Validator::make($request->all(), [
            'comment' => 'required|max:255',
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id'
        ], $messagess);


        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()]);
        }

        if (BookComment::where('book_id', $request->book_id)->where('user_id', $request->user_id)->where('status', 0)->count() > 0) {
            return Response()->json(['error' => 'نظر قبلی  شما هنوز تایید نشده است ، نمی توانید دوباره نظر ارسال کنید']);
        }


        try {

            $comment = new BookComment();
            $comment->comment = $request->comment;
            $comment->user_id = $request->user_id;
            $comment->book_id = $request->book_id;
            $comment->save();

            Audit::create([
                'event' => "ثبت نظر -" . $comment->id,
                'user_id' => auth()->user()->id
            ]);


            return response()->json(['success' => 'نظر با موفقیت ثبت شد، بعد از تایید نمایش داده خواهد شد', 'url' => 'reload']);


        } catch (Exception $exception) {
            return response()->json(['error' => 'خطا در سیستم ، لطفا دوباره امتحان کنید']);
        }


    }
}
