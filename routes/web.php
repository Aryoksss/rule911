<?php

use App\Models\Post;
use App\Livewire\Twit;
use App\Livewire\Posts;
use App\Livewire\Counter;
use Illuminate\Support\Facades\Route;

Route::get('posts', Posts::class)->name('posts')->middleware('auth');

Route::get('/', function () {
    $posts = Post::all(); // Ambil semua data dari tabel posts
    return view('welcome', compact('posts'));
})->name('welcome');;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('counter', Counter::class)->name('counter')->middleware('auth');
Route::get('twit', Twit::class)->name('twit')->middleware('auth');