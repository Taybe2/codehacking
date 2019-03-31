<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

    
Route::get('/post/{id}', ['as' => 'home.post', 'uses' => 'AdminPostsController@post']);

Route::group(['middleware'=>'admin'], function(){
    
    Route::get('/admin', function(){
    
        return view('admin.index');

    });
 
    Route::resource('admin/users', 'AdminUsersController', ['names'=> [
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'edit' => 'admin.users.edit'
    ]]);
    
    Route::resource('admin/posts', 'AdminPostsController', ['names' => [
        'index' => 'admin.posts.index',
        'create' => 'admin.posts.create',
        'edit' => 'admin.posts.edit'
    ]]);
    
    Route::resource('admin/categories', 'AdminCategoriesController', ['names' => [
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'edit' => 'admin.categories.edit'
    ]]);
    
    Route::resource('admin/media', 'AdminMediaController', ['names' => [
        'index' => 'admin.media.index',
        'create' => 'admin.media.create'
    ]]);
    
    Route::delete('admin/delete/media', 'AdminMediaController@deleteMedia');
    
    Route::resource('admin/comments', 'PostCommentsController', ['names' => [
        'index' => 'admin.comments.index',
        'show' => 'admin.comments.show'
    ]]);
    
    Route::resource('admin/comments/replies', 'CommentRepliesController', ['names' => [
        'index' => 'admin.comments.replies.index',
        'show' => 'admin.comments.replies.show'
    ]]);
    
});

Route::group(['middleware'=>'auth'], function(){
    
    Route::post('comment/reply', 'CommentRepliesController@createReply');
    
});
