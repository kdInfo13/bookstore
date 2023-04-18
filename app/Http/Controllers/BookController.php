<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books = Book::with(['categorie', 'authors'])->get();
        return view('book')->with('books', $books);
    }

    public function singleBook($id){
        $book = Book::whereId($id)->with(['categorie', 'authors', 'reviews.user'])->first();
        return view('single')->with('book', $book);
    }
    
}
