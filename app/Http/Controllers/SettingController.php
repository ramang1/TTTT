<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Valuestore\Valuestore;
use File;
class SettingController extends Controller
{
    
    /**
     * Display a listing of the Settings.
     *
     * @param InboxDataTable $inboxDataTable
     * @return Response
     */
    public function index()
    {     
        //echo 'hello';
        $settings = Valuestore::make(storage_path('app/settings.json'));        
        $audios = preg_grep('/^([^.])/', scandir(public_path('media')));        
        return view('settings.index', ['settings' => $settings, 'audios' => $audios]);
    }
}
