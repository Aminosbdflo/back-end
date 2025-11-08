<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Books;
use App\Models\User;
use App\Models\Category;
use App\Models\BookType;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Delete all existing books and related book images
        DB::table('book_images')->delete();
        Books::truncate();

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Get existing users, categories, and book types
        $users = User::all();
        $categories = Category::all();
        $bookTypes = BookType::all();

        // Sample books data
        $books = [
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'published_year' => 1925,
                'genre' => 'Classic Fiction',
                'summary' => 'A classic American novel set in the Jazz Age, exploring themes of wealth, love, and the American Dream.',
                'category_id' => $categories->where('name', 'Fiction')->first()->id,
                'book_type_id' => $bookTypes->where('name', 'pret')->first()->id,
                'status' => 'available',
                'price' => null,
                'user_id' => $users->where('email', 'test@example.com')->first()->id,
                'image' => 'book1.jpg',
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'published_year' => 1960,
                'genre' => 'Drama',
                'summary' => 'A gripping tale of racial injustice and childhood innocence in the American South.',
                'category_id' => $categories->where('name', 'Fiction')->first()->id,
                'book_type_id' => $bookTypes->where('name', 'pret')->first()->id,
                'status' => 'available',
                'price' => null,
                'user_id' => $users->where('email', 'test@example.com')->first()->id,
                'image' => 'book2.jpg',
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'published_year' => 1949,
                'genre' => 'Dystopian',
                'summary' => 'A dystopian social science fiction novel about totalitarian control and surveillance.',
                'category_id' => $categories->where('name', 'Science Fiction')->first()->id,
                'book_type_id' => $bookTypes->where('name', 'vente')->first()->id,
                'status' => 'available',
                'price' => 15.99,
                'user_id' => $users->where('email', 'test@example.com')->first()->id,
                'image' => 'book3.jpg',
            ],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'published_year' => 1937,
                'genre' => 'Fantasy',
                'summary' => 'A fantasy adventure about Bilbo Baggins and his unexpected journey.',
                'category_id' => $categories->where('name', 'Fantasy')->first()->id,
                'book_type_id' => $bookTypes->where('name', 'exchange')->first()->id,
                'status' => 'available',
                'price' => null,
                'user_id' => $users->where('email', 'test@example.com')->first()->id,
                'image' => 'book4.jpg',
            ],
            [
                'title' => 'Sapiens: A Brief History of Humankind',
                'author' => 'Yuval Noah Harari',
                'published_year' => 2011,
                'genre' => 'History',
                'summary' => 'An exploration of the history of humankind from the Stone Age to the modern age.',
                'category_id' => $categories->where('name', 'History')->first()->id,
                'book_type_id' => $bookTypes->where('name', 'pret')->first()->id,
                'status' => 'borrowed',
                'price' => null,
                'user_id' => $users->where('email', 'test@example.com')->first()->id,
                'image' => 'book5.jpg',
            ],
            [
                'title' => 'The Da Vinci Code',
                'author' => 'Dan Brown',
                'published_year' => 2003,
                'genre' => 'Thriller',
                'summary' => 'A mystery thriller involving secret societies and hidden messages.',
                'category_id' => $categories->where('name', 'Mystery')->first()->id,
                'book_type_id' => $bookTypes->where('name', 'vente')->first()->id,
                'status' => 'available',
                'price' => 12.50,
                'user_id' => $users->where('email', 'test@example.com')->first()->id,
                'image' => 'book6.jpg',
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'published_year' => 1813,
                'genre' => 'Romance',
                'summary' => 'A romantic novel about manners, upbringing, morality, and marriage.',
                'category_id' => $categories->where('name', 'Romance')->first()->id,
                'book_type_id' => $bookTypes->where('name', 'exchange')->first()->id,
                'status' => 'available',
                'price' => null,
                'user_id' => $users->where('email', 'test@example.com')->first()->id,
                'image' => 'book7.jpg',
            ],
            [
                'title' => 'Steve Jobs',
                'author' => 'Walter Isaacson',
                'published_year' => 2011,
                'genre' => 'Biography',
                'summary' => 'An authorized biography of Steve Jobs, co-founder of Apple Inc.',
                'category_id' => $categories->where('name', 'Biography')->first()->id,
                'book_type_id' => $bookTypes->where('name', 'pret')->first()->id,
                'status' => 'available',
                'price' => null,
                'user_id' => $users->where('email', 'test@example.com')->first()->id,
                'image' => 'book8.jpg',
            ],
        ];

        foreach ($books as $book) {
            Books::create($book);
        }
    }
}
