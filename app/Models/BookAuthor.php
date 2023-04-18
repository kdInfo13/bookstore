<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BookAuthor extends Model
{
    use HasFactory;

    public function author() : BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    public function book() : BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }
}
