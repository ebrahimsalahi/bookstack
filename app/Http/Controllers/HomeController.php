<?php

namespace App\Http\Controllers;

use App\BookComment;
use App\Book;
use App\Page;
use App\Shelf;


use App\User;
use Illuminate\Support\Facades\Cache;
use morilog\jalalijdate;
use Redis;
use Closure;
class HomeController extends Controller
{
    public function index()
    {

        $pages = Page::orderBy('id', 'DESC')->get();

        $users = User::All()->where('is_active', '1')->count();
        $books = Book::All()->where('status', '1')->count();
        $shelves = Shelf::All()->where('status', '1')->count();

        $comments = BookComment::orderBy('id', 'desc')->where('status', '1')->get();
        $updated_shelves = Shelf::orderBy('updated_at', 'DESC')->limit(15)->get();
        $updated_books = Book::orderBy('updated_at', 'DESC')->limit(5)->get();
        $popular_books = Book::orderBy('view', 'DESC')->limit(10)->get();


        if ( Cache::has('home') ) {
            return Cache::get('home');
        } else {
            $cachedData =  view('theme.home', compact('shelves', 'comments', 'updated_books', 'users', 'books', 'popular_books', 'pages', 'updated_shelves'));
            Cache::put('home',"$cachedData",2);
            return $cachedData;
        }

    }

}
