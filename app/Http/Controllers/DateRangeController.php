<?php

namespace App\Http\Controllers;

use App\DataTables\InboxDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateInboxRequest;
use App\Http\Requests\UpdateInboxRequest;
use App\Repositories\InboxRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Yajra\Datatables\Datatables;
use App\Models\Inbox;
use App\Models\Outbox;
use DB;
use Carbon\Carbon;
use Response;
use App\Models\Contact;
use Notification;
use App\Notifications\Inboxes;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Support\Facades\DB;
use DebugBar;
use Illuminate\Http\Request;
use Post;

class DateRangeController extends Controller
{
    function index(Request $request)
    {
     if(request()->ajax())
     {
         //request in ajax
        \Debugbar::info($request->method());  //Phuogn thuc do Ajax gui len la POST hay GET?
        \Debugbar::info($request->all());  //Nhan tat ca gui len

        \Debugbar::info($request['from_date']);  //Nhan tat ca gui len
        \Debugbar::info($request->input('from_date'));
      if(!empty($request->from_date))
      {
        Carbon::setLocale('vi');

        $from_date   = $request['from_date'] . ' 00:00:00';
        $from_date = \Carbon\Carbon::parse($from_date)->format('Y-m-d H:i:s'); 
        \Debugbar::info('sau convert from date: ' . $from_date);

        $to_date     = $request['to_date'] . ' 23:59:59';
        $to_date = \Carbon\Carbon::parse($to_date)->format('Y-m-d H:i:s'); 
        //$to_date = $to_date->format('d-m-Y H:i:s');
        \Debugbar::info('sau convert to date: ' . $to_date);

        $data = Outbox::select(['name', 'size', 'path', 'type','channel_id','user_id','created_at'])
         ->whereBetween('created_at', array($from_date, $to_date))
         ->get();
      }
      else
      {
       $data = Outbox::select(['name', 'size', 'path', 'type','channel_id','user_id','created_at'])
         ->get();
      }
      return datatables()->of($data)
    ->editColumn('created_at', function ($result)
             {
                 Carbon::setLocale('vi');
                 
                 return $result->created_at->format('d-m-Y H:m:i');
             }
             )
     ->editColumn('channel_id',function($resultChannel)
             {
                 $idGroup = $resultChannel->channel_id;
                 $nameGroup = \App\Models\Channel::where('id', '=', $idGroup)->pluck('name');
                 return $nameGroup[0];
             }
             )
    ->editColumn('user_id',function($resultUser)
             {
                 $idUser = $resultUser->user_id;
                 $User = \App\User::where('id', '=', $idUser)->pluck('name');
                 // return $nameID->name;
                 return $User[0];
             })
    ->make(true);
     }
     return view('outboxes.OutBoxToTal_daterange');
    //  return view('outboxes.outboxTotal');
    }
}
?>
