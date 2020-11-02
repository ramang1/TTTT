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

use Request;
use Post;

class DateRangeController extends Controller
{
    function index(Request $request)
    {
     if(request()->ajax())
     {
      if(!empty($request->from_date))
      {
        // $from_date   = $request->get('from_date');
        // $to_date     = $request->get('to_date');
        $data = Outbox::select(['name', 'id', 'size', 'path', 'type','channel_id','user_id','created_at'])
         ->whereBetween('created_at', array($request->from_date, $request->to_date))
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
