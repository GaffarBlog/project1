<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\ProductAttributeController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\UserRoleController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'AdminMiddleware'])->prefix('admin-area')->group(function () {
    // Mange login page
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'index')->name('admin.login.index');
        Route::post('/login', 'login')->name('admin.login.post');
        Route::get('/logout', 'logout')->name('admin.logout.index');
    });
    Route::controller(PermissionController::class)->group(function () {
        Route::get('/permission/{role_id}', 'index')->name('admin.permissions.view');
        Route::post('/permissions', 'update')->name('admin.permissions.update');
    });
    // dashboard routes
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('admin.dashboard.view');
    });

    // Profile routes
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'profile')->name('admin.profile.view');
        Route::post('/profile', 'update')->name('admin.profile.update');
    });
    Route::controller(UserRoleController::class)->group(function () {
        Route::get('/user-role', 'index')->name('admin.user-role.view');
        Route::post('/user-role', 'create')->name('admin.user-role.create');
        Route::get('/user-role-edit/{id}', 'edit')->name('admin.user-role.edit');
        Route::post('/user-role-update', 'update')->name('admin.user-role.update');
        Route::post('/user-role-delete', 'delete')->name('admin.user-role.delete');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('admin.users.view');
        Route::get('/users/create', 'create')->name('admin.users.createPage');
        Route::post('/users/create', 'create_user')->name('admin.users.create');
        Route::get('/users-edit/{id}', 'edit')->name('admin.users.edit');
        Route::post('/users-update', 'update')->name('admin.users.update');
        Route::post('/users-delete', 'delete')->name('admin.users.delete');
    });
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories/{parent_id?}', 'index')->name('admin.categories.view');
        Route::post('/categories/create', 'create')->name('admin.categories.create');
        Route::get('/categories-edit/{id}', 'edit')->name('admin.categories.edit');
        Route::post('/categories-update', 'update')->name('admin.categories.update');
        Route::post('/categories-delete', 'delete')->name('admin.categories.delete');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index')->name('admin.products.view');
        Route::get('/products/create', 'create_page')->name('admin.products.createPage');
        Route::post('/products/create', 'create')->name('admin.products.create');
        Route::get('/products/subcategories/{category_id}', 'subcategories')->name('admin.products.subcategories');
        Route::get('/products-edit/{id}', 'edit')->name('admin.products.edit');
        Route::post('/products-update', 'update')->name('admin.products.update');
        Route::post('/products-delete', 'delete')->name('admin.products.delete');
    });
    Route::controller(ProductAttributeController::class)->group(function () {
        Route::get('/attributes/{attr?}', 'index')->name('admin.attributes.view');
    });
});
