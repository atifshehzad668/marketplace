<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalemanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use Database\Seeders\AdminSeeder;

Route::get('/', function () {
    return view('auth.login');
})->name('welcome');


Route::middleware('auth')->group(function () {



    Route::get('admin/dashboard', [AdminController::class, 'admin_dashboard'])
        ->middleware('permission:admin-dashboard')
        ->name('admin.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/user/profile/edit/{id}', [UserProfileController::class, 'edit'])->name('user.profile.edit');
    Route::post('/user/profile/update/{id}', [UserProfileController::class, 'update'])->name('user.profile.update');
    Route::get('/user/password/edit/{id}', [UserProfileController::class, 'password_edit'])->name('user.password.edit');
    Route::post('/user/password/update/{id}', [UserProfileController::class, 'password_update'])->name('user.password.update');



    Route::get('/user', [UserController::class, 'index'])->middleware('permission:user-list')->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->middleware('permission:user-create')->name('users.create');
    Route::post('/user/store', [UserController::class, 'store'])->middleware('permission:user-store')->name('users.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->middleware('permission:user-edit')->name('users.edit');
    Route::post('/user/{id}/update', [UserController::class, 'update'])->middleware('permission:user-update')->name('users.update');
    Route::delete('/user/destroy/{id}', [UserController::class, 'destroy'])->middleware('permission:user-delete')->name('users.destroy');





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

    // Leads Routes Start


    Route::get('/leads/create', [LeadController::class, 'create'])
        ->middleware('permission:leads-create')
        ->name('leads.create');
    Route::post('/leads/store', [LeadController::class, 'store'])
        ->middleware('permission:leads-store')
        ->name('leads.store');
    Route::get('/leads/edit/{id}', [LeadController::class, 'edit'])
        ->middleware('permission:leads-edit')
        ->name('leads.edit');
    Route::post('/leads/update/{id}', [LeadController::class, 'update'])
        ->middleware('permission:leads-update')
        ->name('leads.update');
    Route::get('/leads/index', [LeadController::class, 'index'])
        ->middleware('permission:leads-index')
        ->name('leads.index');
    Route::delete('/leads/destroy/{id}', [LeadController::class, 'destroy'])
        ->middleware('permission:leads-destroy')
        ->name('leads.destroy');
    Route::get('/leads/show', [LeadController::class, 'show'])
        ->middleware('permission:leads-show')
        ->name('leads.show');
    Route::get('get/customer/data', [LeadController::class, 'get_customer_data'])

        ->name('get.customer.data');
    // Leads Routes end

    //admin Routes start
    Route::get('admin/con/index', [AdminController::class, 'admin_conversation_index'])->middleware('permission:admin-conversation-index')->name('admin.conversation.index');
    Route::get('admin/con/edit', [AdminController::class, 'admin_conversation_edit'])->middleware('permission:admin-conversation-edit')->name('admin.conversation.edit');
    Route::post('admin/con/update', [AdminController::class, 'admin_conversation_update'])->middleware('permission:admin-conversation-update')->name('admin.conversation.update');
    Route::delete('admin/con/destroy/{id}', [AdminController::class, 'admin_conversation_destroy'])->middleware('permission:admin-conversation-destroy')->name('admin.conversation.destroy');
    Route::get('admin/con/index', [AdminController::class, 'admin_conversation_index'])->middleware('permission:admin-conversation-index')->name('admin.conversation.index');
    Route::get('/leads/filter', [AdminController::class, 'filter'])->name('leads.filter');

    //admin Routes end


    Route::get('notifications',[AdminController::class,'notifications'])->name('notifications');
    Route::get('customer_show',[AdminController::class,'customer_show'])->name('customer.show');



    //Saleman Routes Start
    Route::get('saleman/dashboard', [SalemanController::class, 'index'])->middleware('permission:salesman-dashboard')->name('salesman.dashboard');
    Route::get('saleman/lead/create/{id}', [SalemanController::class, 'create'])->middleware('permission:salesman-lead-create')->name('salesman.lead.accept.create');
    Route::post('saleman/lead/make_sale', [SalemanController::class, 'make_sale'])->middleware('permission:salesman-lead-make_sale')->name('salesman.lead.make_sale.store');
    Route::post('lead/accept', [SalemanController::class, 'lead_accept'])->middleware('permission:salesman-lead-accept')->name('leads.accept');
    Route::get('salesman/leads', [SalemanController::class, 'salesman_leads'])->middleware('permission:salesman-leads')->name('salesman.leads');
    Route::get('salesman/accepted/leads', [SalemanController::class, 'salesman_accepted_leads'])->name('salesman.accepted.leads');
    Route::get('salesman/closed/leads', [SalemanController::class, 'salesman_closed_leads'])->name('salesman.closed.leads');
    Route::get('saleman/conversation/{id}', [SalemanController::class, 'saleman_conversation'])->middleware('permission:salesman-conversation')->name('saleman.conversation');
    Route::Post('saleman/conversation/store/{id}', [SalemanController::class, 'saleman_conversation_store'])->middleware('permission:salesman-conversation-store')->name('saleman.conversation.store');
    Route::get('conversation/index', [SalemanController::class, 'saleman_conversation_index'])->middleware('permission:salesman-conversation-index')->name('saleman.conversation.index');



    //Saleman Routes End
});

require __DIR__ . '/auth.php';
