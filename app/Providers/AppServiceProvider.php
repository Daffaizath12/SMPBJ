<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
{
    // Menggunakan View Composer untuk semua view yang membutuhkan data produk
    View::composer('*', function ($view) {
        $products = Product::all(); // Ambil semua produk
        $view->with('products', $products); // Menyediakan data produk ke semua view
    });
}
}
