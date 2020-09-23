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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/dashboard', 'DashboardController@index')->middleware('verified');
Route::get('/', 'DashboardController@index')->middleware('verified');

Route::get('//dashboard/get_total', 'DashboardController@get_total')->middleware('verified');

Route::resource('users', 'UserController')->middleware('auth');
Route::resource('contacts', 'ContactController')->middleware('auth');

Route::resource('channels', 'ChannelController');

Route::resource('inboxes', 'InboxController');

Route::get('inboxes-unread', 'InboxController@inboxes_unread');
Route::get('inboxes-unread/getdataunread', 'InboxController@getdataunread')->name("users.getdataunread");
//view in tab - of box 4
Route::get('inboxes-unread/getdataunread1', 'InboxController@getdataunread1')->name("users.getdataunread1"); //tab 2 - day
Route::get('inboxes-unread/getdataunread2', 'InboxController@getdataunread2')->name("users.getdataunread2"); //tab 3 - week
Route::get('inboxes-unread/getdataunread3', 'InboxController@getdataunread3')->name("users.getdataunread3"); //tab 4 - month
Route::get('inboxes-unread/getdataunread4', 'InboxController@getdataunread4')->name("users.getdataunread4"); //tab 5 - year


Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');

Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');

Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');

Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');

Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback');

Route::post(
    'generator_builder/generate-from-file',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
)->name('io_generator_builder_generate_from_file');



Route::resource('processInboxes', 'ProcessInboxController');

Route::resource('outboxes', 'OutboxController');

Route::resource('outboxProcesses', 'OutboxProcessController');
//TuanAnh
// Route::get('/dashboard', 'DashboardController@show_inbox');
//Hien thi
// Route::get('/',function(){
//     return view ('dashboard.card');
// });
Route::get('/','InboxController@DatatableInbox');
//Lay du lieu qua ajax showmail
Route::get('/listmail','InboxController@showinbox')->name('users.getData');
//Lay du lieu Checkmail
Route::get('/checkmail','InboxController@CheckMail')->name('mail.getData');


//chi tiet thu chua gui
Route::get('unsend', 'OutboxController@outbox_unsend');
Route::get('unsend/unsenddata', 'OutboxController@unsenddata')->name("users.unsenddata");
Route::get('unsend/unsenddata1', 'OutboxController@unsenddata1')->name("users.unsenddata1");
Route::get('unsend/unsenddata2', 'OutboxController@unsenddata2')->name("users.unsenddata2");
Route::get('unsend/unsenddata3', 'OutboxController@unsenddata3')->name("users.unsenddata3");
Route::get('unsend/unsenddata4', 'OutboxController@unsenddata4')->name("users.unsenddata4");

