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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('new_ticket', 'TicketController@create'); //show the form
Route::post('new_ticket', 'TicketController@store'); //store the form

Route::get('my_tickets', 'TicketController@userTickets');

Route::get('tickets/{ticket_id}', 'TicketController@show');
Route::post('comment', 'CommentsController@postComment');

//https://laravel.com/docs/5.7/routing
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('tickets', 'TicketController@index');
    Route::post('close_ticket/{ticket_id}', 'TicketController@close');
});