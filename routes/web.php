<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MailController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/form', [PostController::class, 'create'])->name('form');
    Route::post('/form', [PostController::class, 'posts']);
    Route::post('/update/{id}', [PostController::class, 'update']);
    Route::delete('/delete/{id}', [PostController::class, 'delete']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/test-log', function () {
    Log::info('This is a test log message');
    return 'Default log created!';
})->middleware(['auth', 'verified']);
Route::get('/test-all-logs', function () {
    Log::debug('Debug message');
    Log::info('Info message');
    Log::warning('Warning message');
    Log::error('Error message');
    return 'All log levels written!';
})->middleware(['auth', 'verified']);
Route::get('/test-login-log', function () {
    Log::channel('login')->info('User logged in', [
        'user_id' => 1,
        'email' => 'test@example.com',
        'ip' => request()->ip(),
    ]);
    return 'Login log created!';
})->middleware(['auth', 'verified']);
Route::get('/test-payment-log', function () {
    Log::channel('payment')->error('Payment failed', [
        'amount' => 500,
        'status' => 'failed',
    ]);
    return 'Payment log created!';
})->middleware(['auth', 'verified']);
Route::get('/test-error', function () {
    Log::channel('errorlog')->error('error', [
        'amount' => 500,
        'status' => 'failed',
    ]);
    return 'Payment log created!';
})->middleware(['auth', 'verified']);
Route::get('/test-critical', function () {
    Log::channel('slack')->critical('🚨 Critical error from Laravel!', [
        'ip' => request()->ip(),
        'time' => now(),
    ]);
    
    return 'Critical log sent to slack!';
})->middleware(['auth', 'verified']);
Route::get('/phpinfo', function () {
    phpinfo();
});
Route::get('/logs', function () {
    return view('logs');
})->middleware(['auth'])->name('logs');

Route::get('/trait', [HomeController::class, 'index'])
    ->middleware(['auth'])
    ->name('trait');

Route::get('/products', [ProductController::class, 'index'])
    ->middleware('auth')
    ->name('products');
    
Route::get('/admin-dashboard', function () {
    return view('admin'); // loads admin.blade.php
})->middleware('role:admin')
  ->name('user-role');

Route::get('/sendmail', [MailController::class, 'index'])->name('sendmail');
Route::post('/sendmail', [MailController::class, 'send'])->name('sendmail.send');