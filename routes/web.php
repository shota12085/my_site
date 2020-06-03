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

Route::get('posts/search', 'Postscontroller@search')->name('posts.search');;
Route::resource('posts', 'PostsController', ['except' => ['index']]);

Route::resource('users', 'UsersController', ['only' => ['show']]);
Route::resource('photos', 'PhotosController', ['only' => ['edit','update','destroy']]);

Route::resource('comments', 'CommentsController', ['only' => ['store','create']])->middleware('auth');

