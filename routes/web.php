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


// Xay dung Box 2 - theo kieu P lam moi

Route::get('inboxTotal','InboxController@inboxTotal');
Route::get('inboxTotal/getdatainboxTotal','InboxController@getdatainboxTotal')->name("users.getdatainboxTotal");
Route::get('inboxTotal/getdatainboxTotal1','InboxController@getdatainboxTotal1')->name("users.getdatainboxTotal1");
Route::get('inboxTotal/getdatainboxTotal2','InboxController@getdatainboxTotal2')->name("users.getdatainboxTotal2");
Route::get('inboxTotal/getdatainboxTotal3','InboxController@getdatainboxTotal3')->name("users.getdatainboxTotal3");
Route::get('inboxTotal/getdatainboxTotal4','InboxController@getdatainboxTotal4')->name("users.getdatainboxTotal4");

//chi tiet thu chua doc
//Box so 4
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

//Xay dung Box 1 - Box tong thu di - theo P lam moi
Route::get('outboxTotal','OutboxController@outboxTotal');
Route::get('outboxTotal/getdataoutboxTotal','OutboxController@getdataoutboxTotal')->name("users.getdataoutboxTotal");

Route::get('outboxTotal/getdataoutboxTotal1','OutboxController@getdataoutboxTotal1')->name("users.getdataoutboxTotal1");
Route::get('outboxTotal/getdataoutboxTotal2','OutboxController@getdataoutboxTotal2')->name("users.getdataoutboxTotal2");
Route::get('outboxTotal/getdataoutboxTota3','OutboxController@getdataoutboxTotal3')->name("users.getdataoutboxTotal3");
Route::get('outboxTotal/getdataoutboxTotal4','OutboxController@getdataoutboxTotal4')->name("users.getdataoutboxTotal4");

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
Route::get('unsend', 'OutboxController@outbox_unsend');
Route::get('unsend/unsenddata', 'OutboxController@unsenddata')->name("users.unsenddata");
Route::get('unsend/unsenddata1', 'OutboxController@unsenddata1')->name("users.unsenddata1");
Route::get('unsend/unsenddata2', 'OutboxController@unsenddata2')->name("users.unsenddata2");
Route::get('unsend/unsenddata3', 'OutboxController@unsenddata3')->name("users.unsenddata3");
Route::get('unsend/unsenddata4', 'OutboxController@unsenddata4')->name("users.unsenddata4");



// thu lam outboxtotal moi
Route::resource('OutBoxToTal_daterange', 'DateRangeController');
