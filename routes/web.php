<?php

use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\User;
use App\Http\Controllers\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

// User
Route::get('user/setting', [User\UserController::class, 'edit']);
Route::put('user', [User\UserController::class, 'update']);
Route::delete('user', [User\UserController::class, 'destroy']);
Route::get('user/{user}', [User\ProfileController::class, 'index']);
Route::get('user/{user}/likes', [User\ProfileController::class, 'likes']);

// Posts
Route::get('/', Post\ShowPostList::class);
Route::resource('posts', Post\PostController::class)->except(['show']);
Route::get('posts/drafts', [Post\PostController::class, 'drafts']);
Route::get('posts/{post}', Post\ShowPost::class);
Route::post('posts/{post}/like', [Post\PostController::class, 'like']);

// Upload files
Route::post('upload/mavon-editor-image', [UploadController::class, 'mavonEditorImage']);

// Comments
Route::resource('posts.comments', Post\CommentController::class)->shallow()->only('store', 'destroy');
