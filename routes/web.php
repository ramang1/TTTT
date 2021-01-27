<?php

use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Spatie\Valuestore\Valuestore;
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

Route::get('/dashboard/get_total', 'DashboardController@get_total')->middleware('verified');

Route::resource('users', 'UserController')->middleware('auth');
Route::resource('contacts', 'ContactController')->middleware('auth');

Route::resource('channels', 'ChannelController');
Route::get('inboxes/unreads', 'InboxController@index');
Route::get('inboxes/actions/{id}', 'InboxController@actions')->middleware('verified');

Route::resource('inboxes', 'InboxController');


Route::get('inboxesdata', 'InboxController@data');
Route::get('outboxesdata', 'OutboxController@data');



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
Route::get('outboxes/unsends', 'OutboxController@index');

Route::get('outboxes/actions/{id}', 'OutboxController@actions')->middleware('verified');

Route::resource('outboxes', 'OutboxController');



Route::resource('outboxProcesses', 'OutboxProcessController');
//TuanAnh


Route::get('/checkmail','InboxController@CheckMail')->name('mail.getData')->middleware('verified');
//Notification dashboard
// Route::get('/', 'InboxController@notificationmail');
//THƯ ĐẾN VÀ ĐI

//Route::get('/dashboard', 'InboxController@showinbox')->middleware('verified');
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
//Test Notification realtime
Route::get('/realtime', 'InboxController@realtime');
Route::get('/sendNotification', 'InboxController@sendNotification')->name('send');
Route::post('/postNotification', 'InboxController@postNotification')->name('postMessage');
//chi tiet thu chua gui


Route::get('/test', function () {  
    $valuestore =  Valuestore::make(storage_path('app/settings.json'));
    $valuestore->put('keytest', 'valuetest');
    $valuestore->put('keytest2', 'valuetest');
    dd($valuestore->get('keytest')); // Returns 'value'
});

//BackUp DB
Route::group(['middleware' => 'auth'], function() {
    Route::post('backups/upload', ['as'=>'backups.upload', 'uses'=>'BackupsController@upload']);
    Route::post('backups/{fileName}/restore', ['as'=>'backups.restore', 'uses'=>'BackupsController@restore']);
    Route::get('backups/{fileName}/dl', ['as'=>'backups.download', 'uses'=>'BackupsController@download']);
    Route::resource('backups','BackupsController');
   
   // Config::set('app.enable_verification', true); 
    // $environment = config('app.enable_verification');
    // dd($environment);

//     config(['world.name' => 'Mundo Hurlingham']);

// config(['world.name' => 'Test']);

//echo config('app.DoThuy');

});
Route::get('services/stop/{id}', 'ServiceController@stop')->middleware('verified')->name('services.stop');
Route::get('services/restart/{id}', 'ServiceController@restart')->middleware('verified')->name('services.restart');
Route::get('services/start/{id}', 'ServiceController@start')->middleware('verified')->middleware('verified')->name('services.start');
Route::get('settings/update', 'SettingController@update')->middleware('verified')->middleware('verified')->name('settings.update');

Route::get('settings', 'SettingController@index')->middleware('verified')->middleware('verified')->name('settings.index');

Route::resource('services', 'ServiceController');