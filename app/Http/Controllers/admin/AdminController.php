<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Books;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        $searchUsers = request('search_users');
        $usersQuery = User::query();
        if ($searchUsers) {
            $usersQuery->where('name', 'like', '%' . $searchUsers . '%')
                       ->orWhere('email', 'like', '%' . $searchUsers . '%');
        }
        $users = $usersQuery->paginate(10);

        $searchBooks = request('search_books');
        $booksQuery = Books::with('user', 'category', 'bookType');
        if ($searchBooks) {
            $booksQuery->where('title', 'like', '%' . $searchBooks . '%')
                       ->orWhere('author', 'like', '%' . $searchBooks . '%');
        }
        $books = $booksQuery->paginate(10);

        $searchTransactions = request('search_transactions');
        $transactionsQuery = Transaction::with('user', 'book', 'approver');
        if ($searchTransactions) {
            $transactionsQuery->whereHas('user', function($q) use ($searchTransactions) {
                $q->where('name', 'like', '%' . $searchTransactions . '%')
                  ->orWhere('email', 'like', '%' . $searchTransactions . '%');
            })->orWhereHas('book', function($q) use ($searchTransactions) {
                $q->where('title', 'like', '%' . $searchTransactions . '%')
                  ->orWhere('author', 'like', '%' . $searchTransactions . '%');
            });
        }
        $transactions = $transactionsQuery->paginate(10);

        $totalTransactions = Transaction::count();

        return view('admin.dashboard', compact('users', 'books', 'transactions', 'searchUsers', 'searchBooks', 'searchTransactions', 'totalTransactions'));
    }

    public function deleteUser($id){
        $user = User::findOrFail($id);
        if($user->usertype == 'admin'){
            return redirect()->route('admin.dashboard')->with('error', 'Cannot delete admin user.');
        }
        $user->delete();
        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
    }

    public function deleteBook($id){
        $book = Books::findOrFail($id);
        $book->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Book deleted successfully.');
    }

    public function approveTransaction($id){
        $transaction = Transaction::findOrFail($id);
        $transaction->status = request('status');
        $transaction->approved_by = Auth::id();
        $transaction->save();

        // Update book status if transaction is completed
        if ($transaction->status === 'completed') {
            if ($transaction->type === 'borrow') {
                $transaction->book->update(['status' => 'borrowed']);
            } elseif ($transaction->type === 'purchase') {
                // For purchase, set to borrowed or sold; assuming borrowed for now
                $transaction->book->update(['status' => 'borrowed']);
            }
        }

        return redirect()->route('admin.dashboard')->with('success', 'Transaction updated successfully.');
    }
}
