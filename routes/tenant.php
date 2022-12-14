<?php

declare(strict_types=1);

use App\Http\Livewire\Tenants\Category;
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


    //FRONT STORE
    Route::get('/', [\App\Http\Controllers\FrontController::class, 'index'])->name('front.store');
    Route::get('single/{slug}', [\App\Http\Controllers\FrontController::class, 'single'])->name('front.single');

    //CART
    Route::prefix('cart')->name('cart.')->group(function(){
        Route::get('/', [\App\Http\Controllers\CartController::class, 'index'])->name('index');
        Route::get('add/{productSlug}', [\App\Http\Controllers\CartController::class, 'add'])->name('add');
        Route::get('remove/{productSlug}', [\App\Http\Controllers\CartController::class, 'remove'])->name('remove');
        Route::get('cancel', [\App\Http\Controllers\CartController::class, 'cancel'])->name('cancel');
    });

    //WEBHOOK
    Route::post('hook', [\App\Http\Controllers\CheckoutController::class, 'hook'])->name('hook');
    Route::get('feedback', [\App\Http\Controllers\CheckoutController::class, 'feedback'])->name('feedback');

    Route::middleware('auth')->group(function(){

        //Checkout controller
        Route::prefix('checkout')->name('checkout.')->group(function() {
            Route::get('/', [\App\Http\Controllers\CheckoutController::class, 'index'])->name('index');
            Route::get('process', [\App\Http\Controllers\CheckoutController::class, 'process'])->name('process');
            Route::get('thanks', [\App\Http\Controllers\CheckoutController::class, 'thanks'])->name('thanks');
        });

        //Order Controller
        Route::get('orders', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders');

        Route::middleware('access.control.store.admin')->prefix('admin')->name('admin.')->group(function() {
            Route::get('dashboard', function () {
                return view('dashboard');
            })->middleware(['auth'])->name('dashboard');

            Route::get('store', [\App\Http\Controllers\Admin\StoreController::class, 'index'])->name('store.index');
            Route::post('store', [\App\Http\Controllers\Admin\StoreController::class, 'store'])->name('store.store');
            Route::get('store/edit', [\App\Http\Controllers\Admin\StoreController::class, 'edit'])->name('store.edit');
            
            Route::get('store/payments', [\App\Http\Controllers\Admin\StorePaymentsController::class, 'index'])->name('store.payments');
            Route::get('store/orders', [\App\Http\Controllers\Admin\StorePaymentsController::class, 'orders'])->name('store.orders');

            Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
            Route::get('category', Category::class)->name('categories.index');
        });
    });


    require __DIR__.'/auth.php';
});
