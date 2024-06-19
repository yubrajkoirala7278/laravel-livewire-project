<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Backend\HomeController as BackendHomeController;
use Illuminate\Support\Facades\Route;

Route::get('/home',[BackendHomeController::class,'index'])->name('admin.home');

Route::view('users','livewire.home')->middleware('permission:access_users');

Route::get('/blogs',[BlogController::class,'home'])->name('blog');
Route::post('/blogs/store', [BlogController::class, 'store'])->name('blogs.store');
Route::put('/blogs/update', [BlogController::class, 'update'])->name('blogs.update');
Route::get('/blogs/index', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [BlogController::class, 'view'])->name('blogs.view');
Route::get('/blogs/{slug}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
Route::delete('/blogs/destroy/{slug}', [BlogController::class, 'destroy'])->name('blogs.destroy');
