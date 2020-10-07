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
Route::get('inboxes-unread/anydata', 'InboxController@anydata')->name("users.anydata");

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
Route::get('/','InboxController@DatatableInbox')->middleware('verified');
//Lay du lieu qua ajax showmail
Route::get('/listmail','InboxController@showinbox')->name('users.getData')->middleware('verified');
//Lay du lieu Checkmail
Route::get('/checkmail','InboxController@CheckMail')->name('mail.getData')->middleware('verified');
//Notification dashboard
// Route::get('/', 'InboxController@notificationmail');
Route::get('/', 'InboxController@showmail')->middleware('verified');
Route::get('/markAsRead/{id}', function($id){
    $id = auth()->user()->unreadNotifications[0]->id;
    auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
	return redirect()->back();
})->name('mark');
//Create Notification insert into database
Route::get('/notify', function () {  
    $users = \App\User::all();
    $details = [
        'body' => 'hello'
    ];
    Notification::send($users, new \App\Notifications\Inboxes($details));
    // $users->notify(new \App\Notifications\Inboxes($details));
    $notification = array(
        'message' => 'Bạn có thông báo mới', 
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);
});

//chi tiet thu chua gui
Route::get('unsend', 'OutboxController@outbox_unsend')->middleware('verified');
Route::get('unsend/unsenddata', 'OutboxController@unsenddata')->name("users.unsenddata")->middleware('verified');
