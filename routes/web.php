<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin', function () {
    // Only users with the "admin" role can access this route
     return view('Admin/index');
})->middleware('checkrole:admin');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/votes/add/{feedback_id}', [App\Http\Controllers\VoteController::class, 'store']);
    Route::get('/votes/delete/{feedback_id}', [App\Http\Controllers\VoteController::class, 'destroy']);

    Route::get('/comments/update/{comment_id}/{status}', [App\Http\Controllers\CommentController::class, 'updateCommentStatus']);

    Route::resource('/feedbacks', 'App\Http\Controllers\FeedbackController'); 
    Route::resource('/comments', 'App\Http\Controllers\CommentController'); 
    Route::resource('/users', 'App\Http\Controllers\UserController'); 
    
});

require __DIR__.'/auth.php';
