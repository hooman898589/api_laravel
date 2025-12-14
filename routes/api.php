<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin')->group(function () {
    Route::post('/users/', [\App\Http\Controllers\Api\Admin\UserConutroller::class, 'store'])->name('admin.users.store');
    Route::get('/mail/{id}', [\App\Http\Controllers\Api\Admin\UserConutroller::class, 'mail'])->name('admin.users.mail');

});