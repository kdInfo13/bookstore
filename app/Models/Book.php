<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
    ];

    /**
    * Get the categoires this books has
    */
    public function categorie() {
        return $this->belongsTo(Categorie::class, 'category_id'); 
    }

    /**
    * Get the categoires this books has
    */
    public function reviews() {
        return $this->hasMany(Review::class, 'book_id'); 
    }


    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_authors', 'book_id', 'author_id');
    }


    public function getTotalReview(){
        return $this->reviews()->count();
    }

    static function getBookAuthor($id){
        return self::whereId($id)->with('authors')->first();
    }
    
    public function getRoundedRating($precision = 1)
    {
        if ($this->reviews()->count() > 0) {
            $rating = $this->reviews()->avg('rating');

            return round((float)$rating, $precision);
        }

        return 0.0;
    }

}
