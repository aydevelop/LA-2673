<?php


Auth::routes();
Route::get('/', 'HomeController@index');
Route::get('/post/{id}', 'PostController@show');

Route::group(['middleware'=>['activeUser','admin']], function(){
    Route::resource('/admin/users', 'AdminUsersController');
});

Route::group(['middleware'=>['activeUser']], function(){
    Route::resource('/admin/users', 'AdminUsersController');
    Route::get('/admin', 'AdminController@index')->name('admin');   
    Route::resource('/admin/posts', 'AdminPostsController');
    Route::resource('/admin/categories', 'AdminCategoriesController');
    Route::get('/admin/logout', 'AdminController@logout');
    Route::post('admin/posts/filter', 'AdminPostsController@filter')->name('posts.filter');
});
