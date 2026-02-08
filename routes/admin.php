<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\UserRoleController;
use Illuminate\Support\Facades\Route;



Route::middleware(['web', "AdminMiddleware"])->prefix('admin-area')->group(function () {
    // Mange login page
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'index')->name('admin.login.index');
        Route::post('/login', 'login')->name('admin.login.post');
        Route::get('/logout', 'logout')->name('admin.logout.index');
    });
    // dashboard routes
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('admin.dashboard.index');
    });

    // Profile routes
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'profile')->name('admin.profile.index');
        Route::post('/profile', 'update')->name('admin.profile.update');
    });
    Route::controller(UserRoleController::class)->group(function () {
        Route::get('/user-role', 'index')->name('admin.user-role.index');
        Route::post('/user-role', 'create')->name('admin.user-role.create');
        Route::get('/user-role-edit/{id}', 'edit')->name('admin.user-role.edit');
        Route::post('/user-role-update', 'update')->name('admin.user-role.update');
        Route::post('/user-role-delete', 'delete')->name('admin.user-role.delete');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('admin.users.index');
        Route::post('/users', 'create')->name('admin.users.create');
        Route::get('/users-edit/{id}', 'edit')->name('admin.users.edit');
        Route::post('/users-update', 'update')->name('admin.users.update');
        Route::post('/users-delete', 'delete')->name('admin.users.delete');
    });
});
