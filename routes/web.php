<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletTransactionController;

Route::get('/admin/dashboad', function () {
    return view('layouts.app');
})->middleware(['auth', 'verified'])->name('admin.dashboard');
Route::get('/', function () {
    return view('auth.login');
})->name('welcome');

Route::get('/user/dashboard', function () {
    return view('front.user_dashboard');
})->middleware(['auth', 'verified'])->name('user.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::get('/practice/create', [PracticeController::class, 'create'])->name('practice.create');
    Route::post('/practice/store', [PracticeController::class, 'store'])->name('practice.store');
    // Route::get('/permission/create', [PermissionController::class, 'create'])->name('permission.create');
    // Route::get('/permission/index', [PermissionController::class, 'index'])->name('permission.index');
    // Route::get('/permission/{id}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
    // Route::post('/permission/{id}/update', [PermissionController::class, 'update'])->name('permission.update');
    // Route::delete('/permission/{id}/destroy', [PermissionController::class, 'destroy'])->name('permission.destroy');





    Route::get('/permissions/index', [PermissionController::class, 'index'])->middleware('permission:permission-list')->name('permission.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->middleware('permission:permission-create')->name('permission.create');
    Route::post('/permission/store', [PermissionController::class, 'store'])->middleware('permission:permission-store')->name('permission.store');
    Route::get('/permissions/edit/{id}', [PermissionController::class, 'edit'])->middleware('permission:permission-edit')->name('permission.edit');
    Route::post('/permissions/update/{id}', [PermissionController::class, 'update'])->middleware('permission:permission-update')->name('permission.update');
    Route::delete('/permissions/delete/{id}', [PermissionController::class, 'destroy'])->middleware('permission:permission-delete')->name('permission.destroy');




    // Role routes
    Route::get('/roles', [RoleController::class, 'index'])
        ->middleware('permission:role-list')
        ->name('roles.index');

    Route::get('/roles/create', [RoleController::class, 'create'])
        ->middleware('permission:role-create')
        ->name('roles.create');

    Route::post('/roles/store', [RoleController::class, 'store'])
        ->middleware('permission:role-create')
        ->name('roles.store');

    Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])
        ->middleware('permission:role-edit')
        ->name('roles.edit');

    Route::post('/roles/update/{id}', [RoleController::class, 'update'])
        ->middleware('permission:role-edit')
        ->name('roles.update');

    Route::delete('/roles/delete/{id}', [RoleController::class, 'destroy'])
        ->middleware('permission:role-delete')
        ->name('roles.destroy');

    // Category routes
    Route::get('/categories', [CategoryController::class, 'index'])
        // ->middleware('permission:category-list')
        ->name('categories.index');

    Route::get('/categories/create', [CategoryController::class, 'create'])
        // ->middleware('permission:category-create')
        ->name('categories.create');

    Route::post('/categories/store', [CategoryController::class, 'store'])
        // ->middleware('permission:category-create')
        ->name('categories.store');

    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])
        // ->middleware('permission:category-edit')
        ->name('categories.edit');

    Route::post('/categories/update/{id}', [CategoryController::class, 'update'])
        // ->middleware('permission:category-edit')
        ->name('categories.update');

    Route::delete('/categories/delete/{id}', [CategoryController::class, 'destroy'])
        // ->middleware('permission:category-delete')
        ->name('categories.destroy');

    // Listing routes
    Route::get('/listings', [ListingController::class, 'index'])
        // ->middleware('permission:listing-list')
        ->name('listings.index');

    Route::get('/listings/create', [ListingController::class, 'create'])
        // ->middleware('permission:listing-create')
        ->name('listings.create');

    Route::post('/listings/store', [ListingController::class, 'store'])
        // ->middleware('permission:listing-create')
        ->name('listings.store');

    Route::get('/listings/edit/{id}', [ListingController::class, 'edit'])
        // ->middleware('permission:listing-edit')
        ->name('listings.edit');

    Route::post('/listings/update/{id}', [ListingController::class, 'update'])
        // ->middleware('permission:listing-edit')
        ->name('listings.update');

    Route::delete('/listings/delete/{id}', [ListingController::class, 'destroy'])
        // ->middleware('permission:listing-delete')
        ->name('listings.destroy');
    Route::get('/listings/show/{id}', [ListingController::class, 'show'])
        // ->middleware('permission:listing-show')
        ->name('listings.show');
    Route::get('/api/regions', [ListingController::class, 'getRegionsByCity']);
    Route::get('/filter/by/city', [MarketplaceController::class, 'filterlistingsbycity'])->name('filter.bycity');
    Route::get('/listings/search', [MarketplaceController::class, 'searchListings'])->name('listing.search');

    // Order routes with individual middleware
    Route::get('/orders', [OrderController::class, 'index'])

        ->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])
        // ->middleware('permission:order-create')
        ->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])
        // ->middleware('permission:order-store')
        ->name('orders.store');
    Route::get('/orders/show/{$id}', [OrderController::class, 'show'])
        // ->middleware('permission:order-show')
        ->name('orders.show');
    Route::get('/orders/edit/{$id}', [OrderController::class, 'edit'])
        // ->middleware('permission:order-edit')
        ->name('orders.edit');
    Route::post('/orders/update/{$id}', [OrderController::class, 'update'])
        // ->middleware('permission:order-update')
        ->name('orders.update');
    Route::delete('/orders//destroy{$id}', [OrderController::class, 'destroy'])
        // ->middleware('permission:order-delete')
        ->name('orders.destroy');






    Route::get('orders/archived', [OrderController::class, 'archived'])

        ->name('orders.archived');


    Route::post('orders/shipping/{id}', [OrderController::class, 'shipping'])->name('orders.shipping');
    Route::post('orders/delivered/{id}', [OrderController::class, 'delivered'])->name('orders.delivered');
    Route::get('delivered/orders', [OrderController::class, 'delivered_orders'])->name('orders.delivered_orders');
    Route::post('received/orders/{id}', [OrderController::class, 'received_orders'])->name('orders.received_orders');
    Route::get('listings/list', [ListingController::class, 'get_listings'])->name('listings.list');


    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/user/{id}/update', [UserController::class, 'update'])->name('users.update');


    Route::get('/filter-by-region', [MarketplaceController::class, 'filterRegionsByCity'])->name('filter.byregion');

    Route::get('/market/place', [MarketplaceController::class, 'marketplace'])->name('market.place');
    Route::get('/listing/view/{id}', [MarketplaceController::class, 'listings_view'])->name('listing.view');
    Route::get('orders/buy/{id}', [MarketplaceController::class, 'buy'])->name('orders.buy');
    Route::get('success', [MarketplaceController::class, 'success'])->name('success');
    Route::get('cancel', [MarketplaceController::class, 'cancel'])->name('cancel');
    Route::get('orders/pending', [MarketplaceController::class, 'pending'])->name('orders.pending');



    // Admin wallet
    Route::get('/admin/wallet', [WalletTransactionController::class, 'admin_wallet'])->middleware('permission:admin-wallet')->name('admin.wallet');
    Route::get('/seller/wallet/balance', [WalletTransactionController::class, 'seller_wallet_balance'])->name('seller_balance.wallet');
    Route::get('/admin/orders', [WalletTransactionController::class, 'admin_orders'])->middleware('permission:admin-orders')->name('admin.orders');
    Route::get('/transaction/description', [WalletTransactionController::class, 'description'])->name('transaction.description');
    Route::get('/seller/wallet', [WalletTransactionController::class, 'seller_wallet'])->middleware('permission:seller-wallet')->name('seller.wallet');
    Route::get('/order/details', [WalletTransactionController::class, 'order_details'])->name('order.details');
    Route::post('/pay/seller', [WalletTransactionController::class, 'pay_to_seller'])->name('pay.seller');
});

require __DIR__ . '/auth.php';