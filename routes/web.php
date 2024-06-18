<?php

use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ============auth=========
Auth::routes();
// =========end of auth========

// ====frontend==========
require __DIR__.'/public.php';
// ======================

// =======backend=======
Route::middleware(['auth.admin'])->group(function(){
    Route::prefix('admin')->group(function(){
        require __DIR__.'/admin.php';
    });
});
// =====================

