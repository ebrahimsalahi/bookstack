<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Book;
use App\Shelf;

class PanelController extends Controller
{
    //
    public function index () 
    {

        $menu = "dashboard";
        $users = User::All();
        $books = Book::All();
        $shelves = Shelf::All();
        return view('panel.index',compact('users','menu','books','shelves'));
    }
}
