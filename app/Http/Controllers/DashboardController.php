<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inbox;
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
        return view('dashboard.index')->with('contacts', $contacts);;
    }

    //Tra ve tong so mail den, di, chua doc
    public function get_total(){

        //Dem tong so dien den trong ngay
        $totalInbox = Inbox::whereDate('created_at', Carbon::today())->count();
   
       //Dem so dien chua dich
       $totalUnread = Inbox::whereNotIn('hash', function($process_hash){
        $process_hash->select('inbox_hash')->from('process_inbox')->where('action', '=', 'giai_nen_zip');
       })->count();

       //Group count dien den
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


       //Dem tong so dien den cua moi don vi

       $inbox_contact_info = DB::table('inboxes')
        ->select('id','contacts.name', DB::raw('count(*) as total'))
        ->join('contacts', function ($join){
           $join->on('inboxes.contact_id', '=', 'contacts.id');})
        ->whereDate('inboxes.created_at', Carbon::today())   
        ->groupBy('contact_id')
        ->get();
        return response()->json(array('totalInbox' => $totalInbox, 'totalOutbox' => '100', 'totalUnsend' => rand(0,10000), 'totalUnread' => $totalUnread, 'inbox_contact_info' => $inbox_contact_info));

    }
}