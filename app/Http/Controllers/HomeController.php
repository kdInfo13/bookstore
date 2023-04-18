<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Auth;
use App\Models\Review;
use App\Models\Book;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function addReview(Request $request){
        $data = $request->validate([
            'rating' => 'required',
            'review' => 'required'
        ]);
        try{
            $input = $request->all();
            $reviews = new Review;
            $reviewExist = $reviews->reviewExist($input['book_id']);
            if($reviewExist == 0){
                $reviews->book_id = $input['book_id'];
                $reviews->user_id =  Auth::id();
                $reviews->rating =  $input['rating'];
                $reviews->review =  $input['review'];
                $reviews->save();
                $Book = new Book;
                $book_authors =  $Book->getBookAuthor($input['book_id']);
             
                if($book_authors){
                    $book_name = $book_authors['title'];
                    foreach($book_authors->authors as $author){
                        dispatch(new \App\Jobs\SendEmails(Auth::user(), $author, $reviews, $book_name));
                    }
                }
                
                return Response::json(array('status'=>true, 'message' => 'posted'));
            }
            return Response::json(array('status'=>false, 'message' => 'Review already posted.'));

        }catch(Execption $e){
            return Response::json(array('status'=>false, 'message' => 'message'));
        }
   
    }
}
