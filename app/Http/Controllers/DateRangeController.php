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
        $from_date   = $request['from_date'] . ' 00:00:00';
        $to_date     = $request['to_date'] . ' 00:00:00';
        $data = Outbox::select(['name', 'id', 'size', 'path', 'type','channel_id','user_id','created_at'])
         ->whereBetween('created_at', array($from_date, $to_date))
         ->get();
      }
      else
      {
       $data = Outbox::select(['name', 'id', 'size', 'path', 'type','channel_id','user_id','created_at'])
         ->get();
      }
      return datatables()->of($data)
      ->editColumn('created_at', function ($result)
             {
                 Carbon::setLocale('vi');
                 return $result->created_at->format('d-m-Y');
             }
             )
    ->make(true);
     }
     return view('outboxes.OutBoxToTal_daterange');
    }
}
?>
