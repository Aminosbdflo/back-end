<?php
namespace App\Http\Controllers;
use App\Models\Books;
use App\Models\Category;
use App\Models\BookType;
use App\Models\Transaction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class BooksController extends Controller
{
    
    public function index(Request $request){
        $search = $request->get('search');
        $books = Books::with('category', 'bookType')->where('user_id', Auth::user()->id);

        if ($search) {
            $books = $books->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('author', 'like', '%' . $search . '%')
                  ->orWhere('genre', 'like', '%' . $search . '%');
            });
        }

        $books = $books->paginate(10)->appends(['search' => $search]);
        $categories = Category::all();
        $bookTypes = BookType::all();
        return view('books', compact('books', 'categories', 'bookTypes'));
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_year' => 'required|integer|min:1000|max:' . (date('Y') + 1),
            'genre' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'category_id' => 'required|exists:category,id',
            'book_type_id' => 'required|exists:book_types,id',
            'status' => 'required|in:available,borrowed,vente',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
            $data['image'] = $imagePath;
        }

        $book = Books::create($data);

        return redirect()->route('user.books')->with('success', 'Book created successfully!');
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_year' => 'required|integer|min:1000|max:' . (date('Y') + 1),
            'genre' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'category_id' => 'required|exists:category,id',
            'book_type_id' => 'required|exists:book_types,id',
            'status' => 'required|in:available,borrowed,vente',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $book = Books::findOrFail($id);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($book->image && Storage::disk('public')->exists($book->image)) {
                Storage::disk('public')->delete($book->image);
            }
            $imagePath = $request->file('image')->store('books', 'public');
            $data['image'] = $imagePath;
        }

        $book->update($data);

        return redirect()->route('user.books')->with('success', 'Book updated successfully!');
    }

    public function destroy($id){
        $book = Books::findOrFail($id);

        // Delete image if exists
        if ($book->image && Storage::disk('public')->exists($book->image)) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();

        return redirect()->route('user.books')->with('success', 'Book deleted successfully!');
    }

    public function requestBook(Request $request, $id){
        $book = Books::findOrFail($id);

        // Check if book is available
        if ($book->status !== 'available') {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Book is not available for request.'], 400);
            }
            return redirect()->back()->with('error', 'Book is not available for request.');
        }

        // Check if user already has a pending request for this book
        $existingRequest = Transaction::where('user_id', Auth::id())
                                      ->where('book_id', $id)
                                      ->where('status', 'pending')
                                      ->first();
        if ($existingRequest) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'You already have a pending request for this book.'], 400);
            }
            return redirect()->back()->with('error', 'You already have a pending request for this book.');
        }

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'book_id' => $id,
            'type' => 'borrow',
            'status' => 'pending',
            'amount' => $book->price ?? null,
            'payment_status' => $book->price > 0 ? 'pending' : null,
        ]);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Book request submitted successfully!']);
        }
        return redirect()->back()->with('success', 'Book request submitted successfully!');
    }

    public function returnBook(Request $request, $id){
        $book = Books::findOrFail($id);

        // Check if the book is borrowed by the current user
        $activeTransaction = Transaction::where('user_id', Auth::id())
                                        ->where('book_id', $id)
                                        ->where('status', 'approved')
                                        ->where('type', 'borrow')
                                        ->first();

        if (!$activeTransaction) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'You do not have an active borrowing transaction for this book.'], 400);
            }
            return redirect()->back()->with('error', 'You do not have an active borrowing transaction for this book.');
        }

        // Update book status to available
        $book->update(['status' => 'available']);

        // Update transaction status to completed
        $activeTransaction->update(['status' => 'completed']);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Book returned successfully!']);
        }
        return redirect()->back()->with('success', 'Book returned successfully!');
    }
}
