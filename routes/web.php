<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function()
{
    Route::get('/articles', function(){
        return view('admin/articles');
    });
    
    Route::get('/durations', function(){
        return view('admin/durations');
    });
    
    Route::get('/events', function(){
        return view('admin/events');
    });
    
    Route::get('/timetables', function(){
        return view('admin/timetables');
    });
    
    Route::get('/assignments', function(){
        return view('admin/assignments');
    });
    
    Route::get('/exams', function(){
        return view('admin/exams');
    });
    
    Route::get('/books', function(){
        return view('admin/books');
    });
    
    Route::get('/users', function(){
        return view('admin/users');
    });

    Route::get('/roles', function(){
        return view('admin/roles');
    });

    Route::get('/subjects', function(){
        return view('admin/subjects');
    });

    Route::get('/eduyears', function(){
        return view('admin/eduyears');
    });

    Route::get('/rooms', function(){
        return view('admin/rooms');
    });

    Route::get('/settings', function(){
        return view('admin/settings');
    });

    Route::get('/users/{id?}', function(){
        return view('admin/profile');
    });

    Route::get('/', 'DashboardController@index');

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
