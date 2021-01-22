<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Valuestore\Valuestore;
use Flash;
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

    public function update(Request $request)
    {     
        $site_name = $request->site_name;
        $time_refresh = $request->time_refresh;
        if($request->has('is_play_audio') && $request->audio_file == 'Chọn file'){
            Flash::error('Vui lòng chọn file âm thanh cần phát khi có điện đến.');
           return redirect(route('settings.index'));
        }
        $valuestore =  Valuestore::make(storage_path('app/settings.json'));
        $valuestore->put('site_name', $site_name);
        $valuestore->put('time_refresh', $time_refresh);
        if($request->has('is_play_audio')){
            $valuestore->put('is_play_audio', $request->is_play_audio);
           

        }else{
            $valuestore->put('is_play_audio', '0');

        }
        $valuestore->put('audio_file', $request->audio_file);
        Flash::success('Lưu cấu hình thành công!');

        return redirect(route('settings.index'));
        
    }
   // return redirect(route('settings.index'));

}
