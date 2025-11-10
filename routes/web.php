<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\ChatController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontEndController;

Route::get('/', [FrontEndController::class, 'home'])->name('home');
Route::get('/library', [FrontEndController::class, 'library'])->name('library');
Route::get('/books/{id}', [FrontEndController::class, 'show'])->name('books.show');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/chat/{ownerId}', [ChatController::class, 'show'])->name('chat.show');
    Route::get('/chat/{ownerId}/messages', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::post('/chat/{ownerId}/send', [ChatController::class, 'sendMessage'])->name('chat.send');

    // Payment routes
    Route::get('/payment/confirm/{bookId}', [App\Http\Controllers\PaymentController::class, 'confirm'])->name('payment.confirm');
    Route::post('/payment/process', [App\Http\Controllers\PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment/success/{transaction_id}', [App\Http\Controllers\PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel', [App\Http\Controllers\PaymentController::class, 'cancel'])->name('payment.cancel');
});



Route::middleware(['auth', 'userMiddleware'])->group(function () {
    Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('conversations', [UserController::class, 'conversations'])->name('conversations');
    Route::get('books',[BooksController::class ,'index'])->name('user.books');
    Route::post('books',[BooksController::class ,'store'])->name('user.books.store');
    Route::put('books/{id}',[BooksController::class ,'update'])->name('user.books.update');
    Route::delete('books/{id}',[BooksController::class ,'destroy'])->name('user.books.destroy');
    Route::post('books/{id}/request',[BooksController::class ,'requestBook'])->name('user.books.request');
    Route::post('books/{id}/return',[BooksController::class ,'returnBook'])->name('user.books.return');


});
Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::delete('/admin/books/{id}', [AdminController::class, 'deleteBook'])->name('admin.books.delete');
    Route::post('/admin/transactions/{id}/approve', [AdminController::class, 'approveTransaction'])->name('admin.transactions.approve');
});



require __DIR__.'/auth.php';
