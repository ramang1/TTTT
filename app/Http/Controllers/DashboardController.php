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
    public function index2()
    {
        // $contacts = Contact::all();
        // $mails = DB::table('inboxes')->get();
        $totalUnread_inbox = Inbox::whereNotIn('id', function ($process_hash) {
            $process_hash
                ->select('inboxes_id')
                ->from('process_inbox')
                ->whereNull('deleted_at')
                ->where('action_type', '=', 'giai_nen_zip')
                ->orWhere('action_type', '=', 'giai_nen_rar');
        })->get();

        return view('dashboard.index')->with('totalUnread_inbox', $totalUnread_inbox); //with('contacts', $contacts)->with('totalUnread_inbox',$totalUnread_inbox )->with('mails',$mails);
    }
    public function index()
    {
        Carbon::setLocale('vi');
        //Lay 10 mail den moi nhat trong ngay
        $showinbox = DB::table('inboxes')->leftjoin('process_inbox', 'process_inbox.inboxes_id', '=', 'inboxes.id')
            ->join('contacts', 'contacts.id', '=', 'inboxes.contact_id')
            ->join('users', 'users.id', '=', 'inboxes.user_id')
            ->selectRaw('contacts.name as contacts_name, users.name as users_name,inboxes.name as name, inboxes.size as size, inboxes.created_at as created_at, process_inbox.inboxes_id as inboxes_id, inboxes.id as inboxes_id, process_inbox.action_type as action')
            ->orderBy('created_at', 'desc')->groupBy('inboxes.id')->take(10)->get();
        //Lay 10 mail di moi nhat trong ngay
        $showoutbox = DB::table('outboxes')
            ->join('contacts', 'contacts.id', '=', 'outboxes.contact_id')
            ->join('users', 'users.id', '=', 'outboxes.user_id')
            ->leftjoin('outbox_process', 'outbox_process.id', '=', 'outboxes.type')
            ->selectRaw('contacts.name as contacts_name, users.name as users_name,outboxes.name as name, outboxes.size as size, outboxes.created_at as created_at,outbox_process.action_type as action, outboxes.id as outboxes_id')
            ->orderBy('created_at', 'desc')->groupBy('outboxes.id')->take(10)->get();

        //Dem tong so mail di, den trong ngay
        $totalInbox = Inbox::whereDate('created_at', Carbon::today())->count();
        // $totalOutbox = OutboxProcess::whereDate('created_at', Carbon::today())->count();
        $totalOutbox = Outbox::whereDate('created_at', Carbon::today())->count();

        //Dem so mail chua doc
        $Unread = Inbox::whereNotIn('id', function ($process_hash) {
            $process_hash
                ->select('inboxes_id')
                ->from('process_inbox')
                ->whereNull('deleted_at')
                ->where('action_type', '=', 'giai_nen_zip')
                ->orWhere('action_type', '=', 'giai_nen_rar');
        })->count();
        //Tong SL Tuyen
        $ChannelsAll = DB::table('channels')->count();
        //Tong SL DV
        $ContactsAll = DB::table('contacts')->count();
        //Tong SL Ủe
        $UsersAll = DB::table('users')->count();
        //Tong SL thu gui va nhan
        $InboxesAll = DB::table('inboxes')->count();
        $OutboxesAll = DB::table('outboxes')->count();

        //Dem so mail chua gui
        $Unsend = Outbox::whereNotIn('id', function ($process_hash) {
            $process_hash
                ->select('id')
                ->from('outbox_process')
                ->whereNull('deleted_at')
                ->where('action_type', '=', 'nen_zip')
                ->orWhere('action_type', '=', 'nen_rar');
        })->count();

        //Dem so mail gui den/di trong ngay cua moi nguoi dung trong he thong
        $contactMailDetail = DB::select('SELECT contacts.id, contacts.name, 
 (SELECT COUNT(*) FROM inboxes WHERE inboxes.contact_id = contacts.id) 
 AS DIENDEN, (SELECT COUNT(*) FROM outboxes WHERE outboxes.contact_id = contacts.id) 
 AS DIENDI FROM contacts
 ORDER BY DIENDEN DESC');


        //Dem so mail truyen nhan trong ngay cua moi nguoi dung
        $userMailDetail = DB::select('SELECT users.id, users.name, 
  (SELECT COUNT(*) FROM inboxes WHERE inboxes.user_id = users.id) 
  AS NHANDIEN, (SELECT COUNT(*) FROM outboxes WHERE outboxes.user_id = users.id) 
  AS TRUYENDIEN FROM users
  ORDER BY NHANDIEN DESC');
       

        \Debugbar::info('So luong Email di den cua moi tuyen');
        \Debugbar::info($contactMailDetail);

        \Debugbar::info('So luong Email truyen nhan cua moi nguoi');
        \Debugbar::info($userMailDetail);

        // \Debugbar::info('So luong Email nen, giai nen cua moi nguoi');
        // \Debugbar::info($userSendRecei);


        return view('dashboard.index')
            ->with('showinbox', $showinbox)
            ->with('showoutbox', $showoutbox)
            ->with('totalInbox', $totalInbox)
            ->with('totalOutbox', $totalOutbox)
            ->with('Unsend', $Unsend)
            ->with('Unread', $Unread)
            ->with('contactMailDetail',$contactMailDetail)
            ->with('ChannelsAll',$ChannelsAll)
            ->with('ContactsAll',$ContactsAll)
            ->with('UsersAll',$UsersAll)
            ->with('InboxesAll',$InboxesAll)
            ->with('OutboxesAll',$OutboxesAll)
            ->with('userMailDetail',$userMailDetail);
    }
    //Tra ve tong so mail den, di, chua doc
    public function get_total()
    {

        //Dem tong so mail di, den trong ngay
        $totalInbox = Inbox::whereDate('created_at', Carbon::today())->count();
        // $totalOutbox = OutboxProcess::whereDate('created_at', Carbon::today())->count();
        $totalOutbox = Outbox::whereDate('created_at', Carbon::today())->count();

        //Dem so mail chua doc
        $totalUnread = Inbox::whereNotIn('id', function ($process_hash) {
            $process_hash
                ->select('inboxes_id')
                ->from('process_inbox')
                ->whereNull('deleted_at')
                ->where('action', '=', 'giai_nen_zip')
                ->orWhere('action', '=', 'giai_nen_rar');
        })->count();


        //Dem so mail chua gui
        $totalUnsend = Outbox::whereNotIn('id', function ($process_hash) {
            $process_hash
                ->select('id')
                ->from('outbox_process')
                ->whereNull('deleted_at')
                ->where('action', '=', 'nen_zip')
                ->orWhere('action', '=', 'nen_rar');
        })->count();





        //Dem tong so mail den cua moi don vi

        $contactInboxDetail = DB::table('inboxes')
            ->select('inboxes.id', 'contacts.name', DB::raw('count(*) as total'))
            ->join('contacts', function ($join) {
                $join->on('inboxes.contact_id', '=', 'contacts.id');
            })
            ->whereDate('inboxes.created_at', Carbon::today())
            ->groupBy('contact_id')
            ->get();

        \Debugbar::info($contactInboxDetail);
        return response()->json(array('totalInbox' => $totalInbox, 'totalOutbox' => $totalOutbox, 'totalUnsend' => $totalUnsend, 'totalUnread' => $totalUnread, 'contactInboxDetail' => $contactInboxDetail));
    }
    //information
    public function information(){
        return view('information');
    }
}
