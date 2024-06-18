<?php

use App\Http\Controllers\Backend\HomeController as BackendHomeController;
use Illuminate\Support\Facades\Route;

Route::get('/home',[BackendHomeController::class,'index'])->name('admin.home');

Route::resources([
    // 'category'=>CategoryController::class,
]); 

