<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function confirm(Request $request, $bookId)
    {
        $book = Books::findOrFail($bookId);

        // Check if book is available/vente and has a price
        if (!in_array($book->status, ['available', 'vente']) || !$book->price) {
            return redirect()->back()->with('error', 'Book is not available for borrowing/purchase.');
        }

        // Check if user already has a pending transaction for this book
        $existingTransaction = Transaction::where('user_id', Auth::id())
                                          ->where('book_id', $book->id)
                                          ->whereIn('status', ['pending', 'completed'])
                                          ->first();
        if ($existingTransaction) {
            return redirect()->back()->with('error', 'You already have a transaction for this book.');
        }

        return view('payment.confirm', compact('book'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Books::findOrFail($request->book_id);

        // Check if book is available/vente and has a price
        if (!in_array($book->status, ['available', 'vente']) || !$book->price) {
            return redirect()->back()->with('error', 'Book is not available for borrowing/purchase.');
        }

        // Check if user already has a pending transaction for this book
        $existingTransaction = Transaction::where('user_id', Auth::id())
                                          ->where('book_id', $book->id)
                                          ->whereIn('status', ['pending', 'completed'])
                                          ->first();
        if ($existingTransaction) {
            return redirect()->back()->with('error', 'You already have a transaction for this book.');
        }

        // Create transaction record as completed
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'type' => $book->status === 'vente' ? 'purchase' : 'borrow',
            'status' => 'completed',
            'amount' => $book->price,
            'payment_status' => 'paid',
            'payment_method' => 'direct',
        ]);

        // Update book status
        if ($transaction->type === 'borrow') {
            $book->update(['status' => 'borrowed']);
        } elseif ($transaction->type === 'purchase') {
            // For purchase, book remains 'vente' or could be marked as sold
            // You might want to add a 'sold' status or handle differently
        }

        return redirect()->route('payment.success', ['transaction_id' => $transaction->id]);
    }

    public function success(Request $request, $transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);

        if ($transaction->user_id !== Auth::id()) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        return view('payment.success', compact('transaction'));
    }

    public function cancel(Request $request)
    {
        return view('payment.cancel');
    }
}
