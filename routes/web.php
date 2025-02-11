<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Posts;
use App\Models\Post;
   
Route::get('posts', Posts::class)->name('posts')->middleware('auth');
Route::get('/', function () {
    $posts = Post::all(); // Ambil semua data dari tabel posts
    return view('welcome', compact('posts'));
})->name('welcome');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
