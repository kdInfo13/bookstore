<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Book;
use App\Models\Author;
use App\Models\BookAuthor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class BookAuthorFactory extends Factory
{
    protected $model = BookAuthor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'author_id' => Author::inRandomOrder()->first()->id,
            'book_id' => Book::inRandomOrder()->first()->id
        ];
    }

}
