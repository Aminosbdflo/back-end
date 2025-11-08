<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function home()
    {

        $books = Books::with('category', 'bookType', 'user')
            ->where('status', 'available')
            ->limit(5)
            ->get();
        return view('front_end.home', compact('books'));
    }

    public function library(Request $request)
    {
        $query = Books::with('category', 'bookType', 'user');

        // Apply filters
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('book_type_id')) {
            $query->where('book_type_id', $request->book_type_id);
        }

        $books = $query->paginate(12)->appends($request->query());

        $categories = \App\Models\Category::all();
        $bookTypes = \App\Models\BookType::all();

        return view('front_end.library', compact('books', 'categories', 'bookTypes'));
    }

    public function show($id)
    {
        $book = Books::with('category', 'bookType', 'user')
            ->findOrFail($id);
        return view('front_end.show', compact('book'));
    }
}
