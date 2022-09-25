<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {

    Route::get('/tenantId', function () {
        return User::all();
        //return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');


    Route::get('/', [\App\Http\Controllers\FrontController::class, 'index'])->name('front.store');

    //CART
    Route::prefix('cart')->name('cart.')->group(function(){
        Route::get('/', [\App\Http\Controllers\CartController::class, 'index'])->name('index');
        Route::get('add/{productSlug}', [\App\Http\Controllers\CartController::class, 'add'])->name('add');
        Route::get('remove/{productSlug}', [\App\Http\Controllers\CartController::class, 'remove'])->name('remove');
        Route::get('cancel', [\App\Http\Controllers\CartController::class, 'cancel'])->name('cancel');
    });

    Route::middleware('auth', 'access.control.store.admin')->group(function(){

        Route::prefix('admin')->name('admin.')->group(function() {
            Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
        });
    });


    //Checkout controller
    Route::get('checkout', [\App\Http\Controllers\CheckoutController::class, 'index']);


    require __DIR__.'/auth.php';
});
