<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminProductManagement;
use App\Http\Controllers\UserManagement;
use App\Http\Controllers\orderManagement;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AddToCart;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderManagementSeller;
use App\Http\Controllers\ProductQrcodeController;
use App\Http\Controllers\orderManagementAdmin;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketControllerSeller;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
   

Auth::routes();


Route::middleware(['auth' ,'role:seller'])->group(function(){
    Route::get('/seller/dashboard', function () {
        return view('/seller/dashboard');
    });
    Route::resource('/seller/product', ProductController::class)->names([
        'index' => 'seller.product.index',
        'create' => 'seller.product.create',
        'store' => 'seller.product.store',
        'show' => 'seller.product.show',
        'edit' => 'seller.product.edit',
        'update' => 'seller.product.update',
        'destroy' => 'seller.product.destroy',
    ]);

    Route::resource('/seller/orders', OrderManagementSeller::class)->names([
        'index' => 'seller.order.index',
        'create' => 'seller.order.create',
        'store' => 'seller.order.store',
        
        'edit' => 'seller.order.edit',
        
        'destroy' => 'seler.order.destroy',]);
        
        Route::post('/seller/orders/{order}', [OrderManagementSeller::class, 'update'])->name('seller.order.update');

Route::get('seller/orders/{orderNumber}', [OrderManagementSeller::class, 'show'])->name('seller.order.show');



    Route::get('/seller/Support', function () {
        return view('/seller/Support');
    });
    Route::get('/product/{id}/qrcode', [ProductQrcodeController::class, 'showQrCode'])->name('product.qrcode');
    Route::resource('/seller/MyAccountPage', MyProfileController::class)->names([
        'index' => 'seller.MyAccount.index',
        'create' => 'seller.MyAccount.create',
        'store' => 'seller.MyAccount.store',
        'show' => 'seller.MyAccount.show',
        'edit' => 'seller.MyAccount.edit',
        'update' => 'seller.MyAccount.update',
        'destroy' => 'seller.MyAccount .destroy',
    ]);

    Route::get('/seller/tickets',[TicketControllerSeller::class,'clientTickets'])->name('seller.tickets');
    Route::post('/seller/tickets/store',[TicketControllerSeller::class,'store'])->name('seller.ticket.store');
});

Route::middleware(['auth' ,'role:user,clientbusiness'])->group(function(){
    Route::get('/', [HomeController::class, 'index']);
    Route::resource('/order', orderManagement::class)->names([
        'index' => 'user.order.index',
        'create' => 'user.order.create',
        'store' => 'user.order.store',
        'show' => 'user.order.show',
        'edit' => 'user.order.edit',
        'update' => 'user.order.update',
        'destroy' => 'user.order.destroy',
    ]);
    Route::resource('/product', ProductController::class)->names([
        'index' => 'user.product.index',
        'create' => 'user.product.create',
        'store' => 'user.product.store',
        'show' => 'user.product.show',
        'edit' => 'user.product.edit',
        'update' => 'user.product.update',
        'destroy' => 'user.product.destroy',
    ]);
    // Route to add an item to the wishlist
    Route::get('/wishlist', [WishlistController::class,'index']);
    Route::post('/wishlist/store', [WishlistController::class,'store'])->name('user.wishlist.store');
    Route::delete('/wishlist/{id}', [WishlistController::class,'destroy'])->name('user.wishlist.destroy');
    // web.php
    Route::post('/cart/add', [AddToCart::class,'addToCart'])->name('cart.add');
    Route::get('/carts', [AddToCart::class, 'showCart'])->name('cart.show');
    Route::delete('/cart/{itemId}', [AddToCart::class, 'removeItem'])->name('cart.remove');
    Route::get('invoice/{orderId}', [InvoiceController::class,'generateInvoice'])->name('invoice');

    
    Route::get('tickets',[TicketController::class,'clientTickets'])->name('client.tickets');
Route::post('tickets/store',[TicketController::class,'store'])->name('client.ticket.store');

});


Route::middleware(['auth' ,'role:admin'])->group(function(){
    Route::get('/admin/dashboard', function () {
        return view('/admin/dashboard');
    });
    Route::resource('/admin/product', AdminProductManagement::class)->names([
        'index' => 'admin.product.index',
        'create' => 'admin.product.create',
        'store' => 'admin.product.store',
        'show' => 'admin.product.show',
        'edit' => 'admin.product.edit',
        'update' => 'admin.product.update',
        'destroy' => 'admin.product.destroy',
    ]);
    Route::resource('/admin/userManagement', UserManagement::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
    Route::resource('/admin/order', orderManagementAdmin::class)->names([
        'index' => 'admin.order.index',
        'create' => 'admin.order.create',
        'store' => 'admin.order.store',
        'edit' => 'admin.order.edit',
        'update' => 'admin.order.update',
        'destroy' => 'admin.order.destroy',
    ]);
    Route::get('admin/orders/{orderNumber}', [OrderManagementAdmin::class, 'show'])->name('admin.order.show');
    Route::resource('/admin/tickets',TicketController::class);

    Route::delete('/admin/tickets/destroy/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');

    Route::post('/admin/tickets/validate',[TicketController::class,'validate_ticket'])->name('tickets.validate');
});