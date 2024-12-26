<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function(){

    Route::post('/auth/register', 'Api\AuthController@RegisterUser')->name('bj.auth.register');
    Route::post('/auth/login', 'Api\AuthController@LoginUser')->name('bj.auth.login');

    Route::prefix('admin')->group(function(){
        Route::middleware('admin.auth')->group(function(){
            Route::get('/users', 'Api\UserController@GetUsers')->name('bj.admin.users');
            Route::get('/users/{username}', 'Api\UserController@GetUser')->name('bj.admin.user');
            Route::post('/users', 'Api\UserController@CreateUser')->name('bj.admin.create-user');
            Route::patch('/users/{username}', 'Api\UserController@UpdateUser')->name('bj.admin.update-user');
            Route::delete('/users/{username}', 'Api\UserController@DeleteUser')->name('bj.admin.delete-user');

            Route::get('/books', 'Api\BookController@GetAllBooks')->name('bj.admin.books');
            Route::get('/books/{book_slug}', 'Api\BookController@GetOneBook')->name('bj.admin.book');
            Route::post('/books', 'Api\BookController@CreateBook')->name('bj.admin.create-book');
            Route::patch('/books/{book_slug}', 'Api\BookController@UpdateBook')->name('bj.admin.update-book');
            Route::delete('/books/{book_slug}', 'Api\BookController@DeleteBook')->name('bj.admin.delete-book');

            Route::get('/book-categories', 'Api\BookCategoryController@GetAllBookCategories')->name('bj.admin.book-categories');
            Route::get('/book-categories/{book_category_code}', 'Api\BookCategoryController@GetOneBookCategory')->name('bj.admin.book-category');
            Route::post('/book-categories', 'Api\BookCategoryController@CreateBookCategory')->name('bj.admin.create-book-category');
            Route::patch('/book-categories/{book_category_code}', 'Api\BookCategoryController@UpdateBookCategory')->name('bj.admin.update-book-category');
            Route::delete('/book-categories/{book_category_code}', 'Api\BookCategoryController@DeleteBookCategory')->name('bj.admin.delete-book-category');

            Route::get('/book-carts', 'Api\BookCartController@GetAllBookCarts')->name('bj.admin.book-carts');
            Route::get('/book-carts/{book_cart_code}', 'Api\BookCartController@GetOneBookCart')->name('bj.admin.book-cart');
            Route::post('/book-carts', 'Api\BookCartController@CreateBookCart')->name('bj.admin.create-book-cart');
            Route::patch('/book-carts/{book_cart_code}', 'Api\BookCartController@UpdateBookCart')->name('bj.admin.update-book-cart');
            Route::delete('/book-carts/{book_cart_code}', 'Api\BookCartController@DeleteBookCart')->name('bj.admin.delete-book-cart');

            Route::get('/messages', 'Api\BookMessageController@GetAllMessagesData')->name('bj.admin.messages');
            Route::get('/messages/detail-message/{messages_code}', 'Api\BookMessageController@GetOneMessageData')->name('bj.admin.message');
            Route::post('/messages', 'Api\BookMessageController@CreateNewMessage')->name('bj.admin.create-new-message');
            Route::post('/messages/detail-message/{messages_code}/reply-message', 'Api\BookMessageController@ReplyExistingMessage')->name('bj.admin.reply-existing-message');
            Route::patch('/messages/detail-message/{messages_code}', 'Api\BookMessageController@UpdateMessage')->name('bj.admin.update-message');
            Route::delete('/messages/detail-message/{messages_code}', 'Api\BookMessageController@DeleteMessage')->name('bj.admin.delete-message');

            Route::get('/invoices', 'Api\BookInvoiceController@GetAllInvoices')->name('bj.admin.invoices');
            Route::get('/invoices/detail-invoice/{book_invoice_code}', 'Api\BookInvoiceController@GetOneInvoice')->name('bj.admin.invoice');
            Route::post('/invoices', 'Api\BookInvoiceController@CreateNewInvoice')->name('bj.admin.create-invoice');
            Route::patch('/invoices/detail-invoice/{book_invoice_code}', 'Api\BookInvoiceController@UpdateInvoiceStatus')->name('bj.admin.update-invoice');
            Route::delete('/invoices/detail-invoice/{book_invoice_code}', 'Api\BookInvoiceController@DeleteInvoice')->name('bj.admin.delete-invoice');

            Route::get('/payments', 'Api\BookPaymentController@GetAllPayments')->name('bj.admin.payments');
            Route::get('/payments/detail-payment/{book_payment_code}', 'Api\BookPaymentController@GetOnePayment')->name('bj.admin.payment');
            Route::post('/payments', 'Api\BookPaymentController@CreateNewPayment')->name('bj.admin.create-payment');
            Route::patch('/payments/detail-payment/{book_payment_code}', 'Api\BookPaymentController@UpdatePayment')->name('bj.admin.update-payment');
            Route::delete('/payments/detail-payment/{book_payment_code}', 'Api\BookPaymentController@DeletePayment')->name('bj.admin.delete-payment');

            Route::get('/balance-transactions', 'Api\BalanceTransactionController@GetAllBalanceTransactions')->name('bj.admin.balance-transactions');
            Route::get('/balance-transactions/detail-balance-transactions/{balance_transaction_uuid}', 'Api\BalanceTransactionController@GetOneBalanceTransaction')->name('bj.admin.balance-transaction');
            Route::post('/balance-transactions', 'Api\BalanceTransactionController@CreateNewBalanceTransaction')->name('bj.admin.create-balance-transaction');

            Route::get('/profile', 'Api\ProfileController@GetProfileData')->name('bj.admin.profile');
            Route::patch('/profile', 'Api\ProfileController@UpdateProfileData')->name('bj.admin.update-profile');
        });
    });

    Route::prefix('user')->group(function(){
        Route::middleware('user.auth')->group(function(){
            Route::get('/books', 'Api\BookController@GetAllBooks')->name('bj.user.books');
            Route::get('/books/{book_slug}', 'Api\BookController@GetOneBook')->name('bj.user.book');

            Route::get('/book-carts/my-cart', 'Api\BookCartController@GetMyCarts')->name('bj.user.my-book-cart');
            Route::get('/book-carts/my-cart/detail-cart/{book_cart_code}', 'Api\BookCartController@GetOneBookCart')->name('bj.user.book-cart');
            Route::post('/book-carts/my-cart', 'Api\BookCartController@CreateBookCart')->name('bj.user.create-book-cart');
            Route::patch('/book-carts/my-cart/detail-cart/{book_cart_code}', 'Api\BookCartController@UpdateBookCart')->name('bj.user.update-book-cart');
            Route::delete('/book-carts/my-cart/detail-cart/{book_cart_code}', 'Api\BookCartController@DeleteBookCart')->name('bj.user.delete-book-cart');

            Route::get('/messages/my-messages', 'Api\BookMessageController@GetAllMessagesByUserIdData')->name('bj.user.my-messages');
            Route::get('/messages/my-messages/detail-message/{messages_code}', 'Api\BookMessageController@GetOneMessageData')->name('bj.user.message');
            Route::post('/messages/my-messages', 'Api\BookMessageController@CreateNewMessage')->name('bj.user.create-new-message');
            Route::post('/messages/my-messages/detail-message/{messages_code}/reply-message', 'Api\BookMessageController@ReplyExistingMessage')->name('bj.user.reply-existing-message');
            Route::patch('/messages/my-messages/detail-message/{messages_code}', 'Api\BookMessageController@UpdateMessage')->name('bj.user.update-message');
            Route::delete('/messages/my-messages/detail-message/{messages_code}', 'Api\BookMessageController@DeleteMessage')->name('bj.user.delete-message');

            Route::get('/invoices/my-invoices', 'Api\BookInvoiceController@GetAllInvoicesByUserId')->name('bj.user.invoices');
            Route::get('/invoices/my-invoices/detail-invoice/{book_invoice_code}', 'Api\BookInvoiceController@GetOneInvoice')->name('bj.user.invoice');

            Route::get('/payments/my-payments', 'Api\BookPaymentController@GetAllPaymentsByUserId')->name('bj.user.payments');
            Route::get('/payments/my-payments/detail-payment/{book_payment_code}', 'Api\BookPaymentController@GetOnePayment')->name('bj.user.payment');

            Route::get('/balance-transactions/my-balance-transactions', 'Api\BalanceTransactionController@GetAllBalanceTransactionsByUserId')->name('bj.user.balance-transactions');
            Route::get('/balance-transactions/my-balance-transactions/detail-balance-transactions/{balance_transaction_uuid}', 'Api\BalanceTransactionController@GetOneBalanceTransaction')->name('bj.user.balance-transaction');
            Route::post('/balance-transactions/my-balance-transactions', 'Api\BalanceTransactionController@CreateNewBalanceTransaction')->name('bj.user.create-balance-transaction');

            Route::get('/profile', 'Api\ProfileController@GetProfileData')->name('bj.user.profile');
            Route::patch('/profile', 'Api\ProfileController@UpdateProfileData')->name('bj.user.update-profile');
        });
    });

});
