<?php

namespace App\Providers;

use App\Repositories\Auth\AuthRepository;
use App\Repositories\Auth\AuthRepositoryInterface;
use App\Repositories\BalanceTransaction\BalanceTransactionRepository;
use App\Repositories\BalanceTransaction\BalanceTransactionRepositoryInterface;
use App\Repositories\Book\BookRepository;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\BookCart\BookCartRepository;
use App\Repositories\BookCart\BookCartRepositoryInterface;
use App\Repositories\BookCategory\BookCategoryRepository;
use App\Repositories\BookCategory\BookCategoryRepositoryInterface;
use App\Repositories\BookInvoice\BookInvoiceRepository;
use App\Repositories\BookInvoice\BookInvoiceRepositoryInterface;
use App\Repositories\BookMessage\BookMessageRepository;
use App\Repositories\BookMessage\BookMessageRepositoryInterface;
use App\Repositories\BookPayment\BookPaymentRepository;
use App\Repositories\BookPayment\BookPaymentRepositoryInterface;
use App\Repositories\Profile\ProfileRepository;
use App\Repositories\Profile\ProfileRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);

        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ProfileRepositoryInterface::class, ProfileRepository::class);
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
        $this->app->bind(BookCategoryRepositoryInterface::class, BookCategoryRepository::class);
        $this->app->bind(BookCartRepositoryInterface::class, BookCartRepository::class);
        $this->app->bind(BookMessageRepositoryInterface::class, BookMessageRepository::class);
        $this->app->bind(BookInvoiceRepositoryInterface::class, BookInvoiceRepository::class);
        $this->app->bind(BookPaymentRepositoryInterface::class, BookPaymentRepository::class);
        $this->app->bind(BalanceTransactionRepositoryInterface::class, BalanceTransactionRepository::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
