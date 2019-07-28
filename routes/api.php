<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('articles' , 'ArticlesController');
Route::put('article', 'ArticlesController@store');

Route::resource('assignments' , 'AssignmentsController');
Route::put('assignment', 'AssignmentsController@store');

Route::resource('attendances' , 'AttendancesController');
Route::put('attendance', 'AttendancesController@store');

Route::resource('books' , 'BooksController');
Route::put('books', 'BooksController@store');

Route::resource('durations' , 'DurationsController');
Route::put('duration', 'DurationsController@store');

Route::resource('events' , 'EventsController');
Route::put('event', 'EventsController@store');

Route::resource('exams' , 'ExamsController');
Route::put('exam', 'ExamsController@store');

Route::resource('roles' , 'RolesController');
Route::put('role', 'RolesController@store');

Route::resource('subjects' , 'SubjectsController');
Route::put('subject', 'SubjectsController@store');

Route::resource('timetables' , 'TimetablesController');
Route::put('timetables', 'TimetablesController@store');

Route::resource('users' , 'UsersController');
Route::put('users', 'UsersController@store');

Route::resource('roles' , 'RolesController');
Route::put('roles', 'RolesController@store');

Route::resource('countries' , 'CountriesController');

Route::resource('eduyears' , 'EduyearsController');
Route::put('eduyear', 'EduyearsController@store');

Route::resource('rooms' , 'RoomsController');
Route::put('room', 'RoomsController@store');

Route::resource('settings' , 'SettingsController');
Route::put('setting', 'SettingsController@store');
