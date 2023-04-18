<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categorie;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookAuthor;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed categories
        $categories = Categorie::factory(5)->create();

        // Seed author
        $author = Author::factory(20)->create();

        // Seed books
        $books = Book::factory(10)->create();

        // Seed author book
        $books = BookAuthor::factory(50)->create();

    }
}
