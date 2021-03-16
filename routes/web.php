<?php

use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Spatie\Valuestore\Valuestore;
use Carbon\Carbon;
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

Auth::routes(['verify' => true]);

Route::get('/dashboard', 'DashboardController@index')->middleware('verified')->name('dashboard.index');
Route::get('/', 'DashboardController@index')->middleware('verified');

// Route::get('/dashboard/get_total', 'DashboardController@get_total')->middleware('verified');

Route::resource('users', 'UserController')->middleware('auth');
Route::resource('contacts', 'ContactController')->middleware('auth');

Route::resource('channels', 'ChannelController');
Route::get('inboxes/unreads', 'InboxController@index')->name('inboxes.unreads');
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
Route::get('outboxes/unsends', 'OutboxController@index')->name('outboxes.unsends');

Route::get('outboxes/actions/{id}', 'OutboxController@actions')->middleware('verified');

Route::resource('outboxes', 'OutboxController');

Route::resource('outboxProcesses', 'OutboxProcessController');
//TuanAnh

Route::get('/checkmail','InboxController@CheckMail')->name('mail.getData')->middleware('verified');



Route::get('/test', function () {  
    // $valuestore =  Valuestore::make(storage_path('app/settings.json'));
    // $valuestore->put('keytest', 'valuetest');
    // $valuestore->put('keytest2', 'valuetest');
    // dd($valuestore->get('keytest')); // Returns 'value'

    //dd(Carbon::today()->timezone('Asia/Ho_Chi_Minh'));
    dd(Carbon::today());
});

//BackUp DB
Route::group(['middleware' => 'auth'], function() {
    Route::post('backups/upload', ['as'=>'backups.upload', 'uses'=>'BackupsController@upload'])->middleware(['auth', 'password.confirm']);
    Route::post('backups/{fileName}/restore', ['as'=>'backups.restore', 'uses'=>'BackupsController@restore'])->middleware(['auth', 'password.confirm']);
    Route::get('backups/{fileName}/dl', ['as'=>'backups.download', 'uses'=>'BackupsController@download'])->middleware(['auth', 'password.confirm']);
    Route::resource('backups','BackupsController')->middleware(['auth', 'password.confirm']);
   
});
Route::get('services/stop/{id}', 'ServiceController@stop')->middleware('verified')->name('services.stop')->middleware(['auth', 'password.confirm']);
Route::get('services/restart/{id}', 'ServiceController@restart')->middleware('verified')->name('services.restart')->middleware(['auth', 'password.confirm']);
Route::get('services/start/{id}', 'ServiceController@start')->middleware('verified')->middleware('verified')->name('services.start')->middleware(['auth', 'password.confirm']);
Route::get('settings/update', 'SettingController@update')->middleware('verified')->middleware('verified')->name('settings.update')->middleware(['auth', 'password.confirm']);

Route::get('settings', 'SettingController@index')->middleware('verified')->middleware('verified')->name('settings.index');

Route::resource('services', 'ServiceController');
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('verified')->name('logs.index');
//Gioi thieu Website
Route::get('/information','DashboardController@information');
//Xem va chinh sua User
Route::get('/userdetails','UserController@userdetails')->middleware('verified');
Route::post('/update-userdetails/{id}','UserController@update_userdetails')->middleware('verified');