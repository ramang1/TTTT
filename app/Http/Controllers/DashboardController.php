<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inbox;
use App\Models\Outbox;
use App\Models\OutboxProcess;
use Carbon\Carbon;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();
        $mails = DB::table('inboxes')->get();
        $totalUnread_inbox = Inbox::whereNotIn('id', function($process_hash){
            $process_hash
            ->select('inboxes_id')
            ->from('process_inbox')
            ->whereNull('deleted_at')
            ->where('action', '=', 'giai_nen_zip')
            ->orWhere('action', '=', 'giai_nen_rar');
           })->get();

        return view('dashboard.index')->with('contacts', $contacts)->with('totalUnread_inbox',$totalUnread_inbox )->with('mails',$mails);
    }

    //Tra ve tong so mail den, di, chua doc
    public function get_total(){

        //Dem tong so mail di, den trong ngay
        $totalInbox = Inbox::whereDate('created_at',Carbon::today())->count();
        // $totalOutbox = OutboxProcess::whereDate('created_at', Carbon::today())->count();
        $totalOutbox = Outbox::whereDate('created_at', Carbon::today())->count();

        //Dem so mail chua doc
        $totalUnread = Inbox::whereNotIn('id', function($process_hash){
        $process_hash
        ->select('inboxes_id')
        ->from('process_inbox')
        ->whereNull('deleted_at')
        ->where('action', '=', 'giai_nen_zip')
        ->orWhere('action', '=', 'giai_nen_rar');
       })->count();


       //Dem so mail chua gui
       $totalUnsend = Outbox::whereNotIn('id', function($process_hash){
        $process_hash
        ->select('id')
        ->from('outbox_process')
        ->whereNull('deleted_at')
        ->where('action', '=', 'nen_zip')
        ->orWhere('action', '=', 'nen_rar');
       })->count();


       //Dem so mail chua
       //Group count mail den
       //$inbox_info = DB::table('inboxes')->select('contact_id', DB::raw('count(*) as total'))->whereDate('created_at', Carbon::today())->groupBy('contact_id')->orderBy('total', 'DESC')->get();
       //$inbox_info = DB::table('inboxes')->select('contact_id', DB::raw('count(*) as total'))->join('contacts', 'contact_id', '=', 'contacts.id'); //->whereDate('created_at', Carbon::today())->groupBy('contact_id')->orderBy('total', 'DESC');

    //    $temp = DB::raw(
    //     'SELECT count(*) as total, C.id, C.Name
    //     FROM inboxes
    //     JOIN contacts
    //       ON inboxes.contact_id = contacts.id
    //    GROUP BY inboxes.contact_id'
    //    );
       // $temp = DB::raw('SELECT contacts.name, count(*) as total FROM inboxes JOIN contacts ON inboxes.contact_id = contacts.id GROUP BY inboxes.contact_id');


       //Dem tong so mail den cua moi don vi

       $inbox_contact_info = DB::table('inboxes')
        ->select('inboxes.id','contacts.name', DB::raw('count(*) as total'))
        ->join('contacts', function ($join){
           $join->on('inboxes.contact_id', '=', 'contacts.id');})
        ->whereDate('inboxes.created_at', Carbon::today())
        ->groupBy('contact_id')
        ->get();

        \Debugbar::info($inbox_contact_info);
        return response()->json(array('totalInbox' => $totalInbox, 'totalOutbox' => $totalOutbox, 'totalUnsend' => $totalUnsend, 'totalUnread' => $totalUnread, 'inbox_contact_info' => $inbox_contact_info));

    }

    //TuanAnh-ShowThuDen
    // public function show_inbox(){

    //     $data=DB::table('inboxes')->orderby('id','desc')->get();
    //     $all_inbox=view('dashboard.card')->with(['data',$data]);
    //     return view('dashboard.index')->with('dashboard.card',$all_inbox);

    // }



}
