<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('/', 'PostsController@index')->name('posts.index');

// Route::get('/index', 'Postscontroller@index');
Route::resource('posts', 'PostsController', ['except' => ['index']]);

Route::resource('users', 'UsersController', ['only' => ['show']]);

Route::resource('comments', 'CommentsController', ['only' => ['store','create']])->middleware('auth');

