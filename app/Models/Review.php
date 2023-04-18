<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Review extends Model
{
    use HasFactory;


    static function reviewExist($id){
        return self::where(['book_id' => $id, 'user_id' => Auth::id()])->count();
    }

    /**
    * Gets the book a category belongs to
    */
    public function book() {
        return $this->belongsTo(Book::class);
    }

    /**
    * Gets the book a category belongs to
    */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
