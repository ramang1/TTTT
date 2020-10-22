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
use DB;
use Carbon\Carbon;
use Response;
use App\Models\Contact;
use Notification;
use App\Notifications\Inboxes;
use Illuminate\Notifications\Notifiable;
use Pusher\Pusher;
use Illuminate\Http\Request;
use stdClass;
// use Illuminate\Support\Facades\DB;
use Session;
class InboxController extends AppBaseController
{
    /** @var  InboxRepository */
    private $inboxRepository;

    public function __construct(InboxRepository $inboxRepo)
    {
        $this->inboxRepository = $inboxRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the Inbox.
     *
     * @param InboxDataTable $inboxDataTable
     * @return Response
     */
    public function index(InboxDataTable $inboxDataTable)
    {
        return $inboxDataTable->render('inboxes.index');
    }

    /**
     * Show the form for creating a new Inbox.
     *
     * @return Response
     */
    public function create()
    {
        return view('inboxes.create');
    }

    /**
     * Store a newly created Inbox in storage.
     *
     * @param CreateInboxRequest $request
     *
     * @return Response
     */
    public function store(CreateInboxRequest $request)
    {
        $input = $request->all();

        $inbox = $this->inboxRepository->create($input);

        Flash::success('Inbox saved successfully.');

        return redirect(route('inboxes.index'));
    }

    /**
     * Display the specified Inbox.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $inbox = $this->inboxRepository->find($id);

        if (empty($inbox)) {
            Flash::error('Inbox not found');

            return redirect(route('inboxes.index'));
        }

        return view('inboxes.show')->with('inbox', $inbox);
    }

    /**
     * Show the form for editing the specified Inbox.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $inbox = $this->inboxRepository->find($id);

        if (empty($inbox)) {
            Flash::error('Inbox not found');

            return redirect(route('inboxes.index'));
        }

        return view('inboxes.edit')->with('inbox', $inbox);
    }

    /**
     * Update the specified Inbox in storage.
     *
     * @param  int              $id
     * @param UpdateInboxRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInboxRequest $request)
    {
        $inbox = $this->inboxRepository->find($id);

        if (empty($inbox)) {
            Flash::error('Inbox not found');

            return redirect(route('inboxes.index'));
        }

        $inbox = $this->inboxRepository->update($request->all(), $id);

        Flash::success('Inbox updated successfully.');

        return redirect(route('inboxes.index'));
    }

    /**
     * Remove the specified Inbox from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $inbox = $this->inboxRepository->find($id);

        if (empty($inbox)) {
            Flash::error('Inbox not found');

            return redirect(route('inboxes.index'));
        }

        $this->inboxRepository->delete($id);

        Flash::success('Inbox deleted successfully.');

        return redirect(route('inboxes.index'));
    }

    //TuanAnh
    //ShowInboxIndex
        // public function showinbox(){
        //     return Datatables::of(Inbox::query())->make(true);
        // }
        public function showinbox()
        {
            $data = DB::table('inboxes')->select([ 'name', 'path', 'created_at'])->orderBy('created_at','desc');

            return Datatables::of($data)
            ->editColumn('created_at', function ($data) {
                if($data->created_at == null) {
                    return $data->created_at ?  : 'Unknown';
                }
                    Carbon::setLocale('vi');
                    return $data->created_at ? with(new Carbon($data->created_at))->diffForHumans() : '';
                })
                ->filterColumn('created_at', function ($query, $keyword) {
                    $query->whereRaw("DATE_FORMAT(created_at,'%m/%d/%Y') like ?", ["%$keyword%"]);
                })
                ->make(true);
        }
        public function datamails(){
        Carbon::setLocale('vi');
        //lay dl tra ve
        $data = Inbox::whereNotIn('id', function($process_hash){
            $process_hash
            ->select('inboxes_id')
            ->from('process_inbox')
            ->whereNull('deleted_at')
            ->where('action', '=', 'giai_nen_zip')
            ->orWhere('action', '=', 'giai_nen_rar');
           })->orderBy('created_at','desc')->limit(10)->get();
           for ( $i =0; $i< sizeof($data); $i++){
            $data[$i]->timeCarbon =  $data[$i]->created_at->diffForHumans();
            $name = Contact::where('id','=',$data[$i]->contact_id)->pluck('name');
            $data[$i]->contact_name =  $name[0];}
        //session lan dau
        
       // If( isset( $_SESSION["CUR_DATA_INBOX"]) ){
           if (!Session::has('CUR_DATA_INBOX')){
           
             Session::put('CUR_DATA_INBOX',$data);
             \Debugbar::error('Chay lan dau');
            return json_encode($data );
        }
        
        if ($data == Session::get('CUR_DATA_INBOX')) {
            \Debugbar::error('Khong Co du lieu moi');
            return json_encode((object) null);
        }
        //Du lieu moi
        else {
            \Debugbar::error('Co du lieu moi');
        
            Session::put('CUR_DATA_INBOX',$data);
            return json_encode($data);
        }
    
        }
    public function action($id){
        DB::table('inboxes')->where('id',$id)->update(['name'=>11]);
        $thongbao = array('message'=>'Thay doi ten thanh cong','alert-type'=>'warning');
        // return Redirect::to('');
        return view('dashboard.index')->with($thongbao);
    }
    public function DatatableInbox()
    {
        return view('dashboard.index');
    }
    public function CheckMail()
    {
        $data = DB::table('process_inbox')->join('inboxes', 'process_inbox.inboxes_id', '=', 'inboxes.id')
            ->select(['process_inbox.action', 'process_inbox.note', 'process_inbox.description', 'inboxes.name', 'process_inbox.created_at'])->orderBy('created_at','desc');

        return Datatables::of($data)
            // ->editColumn('title', '{!! str_limit($title, 60) !!}')
            // ->editColumn('name', function ($model) {
            //     return \HTML::mailto($model->email, $model->name);
            // })

            ->editColumn('created_at', function ($data) {
                if($data->created_at == null) {
                    // $data->created_at = '1/1/1900';
                    return $data->created_at ?  : 'Unknown';
                }
                    Carbon::setLocale('vi');
                    return $data->created_at ? with(new Carbon($data->created_at))->diffForHumans() : '';
            })


            ->make(true);
    }

//  git config --global user.email "you@example.com"
//   git config --global user.name "TuanAnh"

    public function inboxes_unread(Request $request)
    {
        $contacts = Contact::all();
        // $data = DB::table('inboxes')->get();

        $totalUnread_inbox = Inbox::whereNotIn('id', function($process_hash){
            $process_hash
            ->select('inboxes_id')
            ->from('process_inbox')
            ->whereNull('deleted_at')
            ->where('action', '=', 'giai_nen_zip')
            ->orWhere('action', '=', 'giai_nen_rar');
           })->get();

        return view('inboxes.unread')->with('contacts', $contacts)->with('totalUnread_inbox',$totalUnread_inbox );
    }
    public function getdataunread(Request $request)
    {
        $result = Inbox::select(['name', 'contact_id', 'size', 'path', 'created_at']);
            return Datatables::of($result)
            ->editColumn('created_at', function ($result) {
            if($result->created_at == null)
            {
                return $result->created_at ?  : 'Unknown';
            }
                Carbon::setLocale('vi');
                return $result->created_at->format('d-m-Y - H:i:s');
                //? with(new Carbon($data->created_at))->diffForHumans() : '';
            })
            ->make(true);
        // }
    }

    //for tab-2 get data of day of box 4
    public function getdataunread1(Request $request)
    {
       $result1 = Inbox::select(['name', 'contact_id', 'size', 'path', 'created_at'])->whereDate('created_at', Carbon::today())->get();
        // $result = Inbox::select(['name', 'contact_id', 'size', 'path', 'created_at'])->whereBetween('created_at', [$start_week, $end_week])->get();

            return Datatables::of($result1)
            ->editColumn('created_at', function ($result11)
            {
                Carbon::setLocale('vi');
                return $result11->created_at->format('d-m-Y - H:i:s');
            }
            )
            ->make(true);
    }

    //for tab-3 get data of week of box 4
    public function getdataunread2(Request $request)
    {

                $result = Inbox::select(['name', 'contact_id', 'size', 'path', 'created_at'])->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
                return Datatables::of($result)
                ->editColumn('created_at', function ($result)
                {
                    Carbon::setLocale('vi');
                    return $result->created_at->format('d-m-Y - H:i:s');
                }
                )
                ->make(true);
    }
    public function getdataunread3(Request $request)
    {
                $result = Inbox::select(['name', 'contact_id', 'size', 'path', 'created_at'])->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
                return Datatables::of($result)
                ->editColumn('created_at', function ($result)
                {
                    Carbon::setLocale('vi');
                    return $result->created_at->format('d-m-Y - H:i:s');
                }
                )
                ->make(true);
    }
    public function getdataunread4(Request $request)
    {
                $result = Inbox::select(['name', 'contact_id', 'size', 'path', 'created_at'])->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
                return Datatables::of($result)
                ->editColumn('created_at', function ($result)
                {
                    Carbon::setLocale('vi');
                    return $result->created_at->format('d-m-Y - H:i:s');
                }
                )
                ->make(true);
    }



    // Viet ham cho box so 2 - inboxTotal
    public function inboxTotal()
    {
        $contacts = Contact::all();

        return view('inboxes.inboxTotal')->with('contacts', $contacts);

    }


    // tong thu den box 2 - tab so 1
    public function getdatainboxTotal(Request $request)
    {
        $result_box2 = Inbox::select(['name', 'contact_id', 'size', 'path', 'type','user_id','created_at']);
            return Datatables::of($result_box2)
            ->editColumn('created_at', function ($result) {
            if($result->created_at == null)
            {
                return $result->created_at ?  : 'Unknown';
            }
                Carbon::setLocale('vi');
                return $result->created_at->format('d-m-Y - H:i:s');
                //? with(new Carbon($data->created_at))->diffForHumans() : '';
            })
            ->editColumn('user_id', function($result)
            {
                $idUser = $result->user_id;
                // $nameID = DB::table('users')->join('inboxes','users.id','=','inboxes.user_id')->where('users.id','=', $idUser)->select('users.name')->first();
                $User = \App\User::where('id', '=', $idUser)->pluck('name');
                // return $nameID->name;
                return $User[0];
            }

            )
            ->make(true);
        // }
    }

    // tong thu den box 2 - tab so 2
    public function getdatainboxTotal1(Request $request)
    {
        $result_box2_tab2 = Inbox::select(['name', 'contact_id', 'size', 'path', 'type','user_id','created_at'])->whereDate('created_at', Carbon::today())->get();

            return Datatables::of($result_box2_tab2)
            ->editColumn('created_at', function ($result22)
            {
                Carbon::setLocale('vi');
                return $result22->created_at->format('d-m-Y - H:i:s');
            }
            )
            ->editColumn('user_id', function($result)
            {
                $idUser = $result->user_id;
                // $nameID = DB::table('users')->join('inboxes','users.id','=','inboxes.user_id')->where('users.id','=', $idUser)->select('users.name')->first();
                $User = \App\User::where('id', '=', $idUser)->pluck('name');
                // return $nameID->name;
                return $User[0];
            }
            )
            ->make(true);
    }

    // tong thu den box 2 - tab so 3
    public function getdatainboxTotal2(Request $request)
    {
        $result_box2_tab3 = Inbox::select(['name', 'contact_id', 'size', 'path', 'type','user_id','created_at'])->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();

            return Datatables::of($result_box2_tab3)
            ->editColumn('created_at', function ($result23)
            {
                Carbon::setLocale('vi');
                return $result23->created_at->format('d-m-Y - H:i:s');
            }
            )
            ->editColumn('user_id', function($result)
            {
                $idUser = $result->user_id;
                // $nameID = DB::table('users')->join('inboxes','users.id','=','inboxes.user_id')->where('users.id','=', $idUser)->select('users.name')->first();
                $User = \App\User::where('id', '=', $idUser)->pluck('name');
                // return $nameID->name;
                return $User[0];
            }
            )
            ->make(true);
    }

    // tong thu den box 2 - tab so 4
    public function getdatainboxTotal3(Request $request)
    {
        $result_box2_tab4 = Inbox::select(['name', 'contact_id', 'size', 'path', 'type','user_id','created_at'])->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();

            return Datatables::of($result_box2_tab4)
            ->editColumn('created_at', function ($result24)
            {
                Carbon::setLocale('vi');
                return $result24->created_at->format('d-m-Y - H:i:s');
            }
            )
            ->editColumn('user_id', function($result)
            {
                $idUser = $result->user_id;
                // $nameID = DB::table('users')->join('inboxes','users.id','=','inboxes.user_id')->where('users.id','=', $idUser)->select('users.name')->first();
                $User = \App\User::where('id', '=', $idUser)->pluck('name');
                // return $nameID->name;
                return $User[0];
            }
            )
            ->make(true);
    }

    // tong thu den box 2 - tab so 5
    public function getdatainboxTotal4(Request $request)
    {
        $result_box2_tab5 = Inbox::select(['name', 'contact_id', 'size', 'path', 'type','user_id','created_at'])->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();

            return Datatables::of($result_box2_tab5 )
            ->editColumn('created_at', function ($result25)
            {
                Carbon::setLocale('vi');
                return $result25->created_at->format('d-m-Y - H:i:s');
            }
            )
            ->editColumn('user_id', function($result)
            {
                $idUser = $result->user_id;
                // $nameID = DB::table('users')->join('inboxes','users.id','=','inboxes.user_id')->where('users.id','=', $idUser)->select('users.name')->first();
                $User = \App\User::where('id', '=', $idUser)->pluck('name');
                // return $nameID->name;
                return $User[0];
            }
            )
            ->make(true);
    }

    //TuanAnh Notification



    public function showmail(){
        return view ('dashboard.index',[
            'notifications' => auth()->user()->notifications
        ]);
    }
    //Notification Realtime
    public function sendNotification()
    {
        return view('notifications.send_notification');
    }
    public function postNotification(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        
        $data['title'] = $request->input('title');
        $data['content'] = $request->input('content');

        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger('Notify', 'SendNotify', $data);

        return redirect()->route('send');
    }
    public function realtime()
    {
        return view('notifications.realtime_notification');
    }

}
