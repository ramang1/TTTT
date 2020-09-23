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
use Request;
use Post;

class InboxController extends AppBaseController
{
    /** @var  InboxRepository */
    private $inboxRepository;

    public function __construct(InboxRepository $inboxRepo)
    {
        $this->inboxRepository = $inboxRepo;
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
            $data = DB::table('inboxes')->select([ 'name', 'path', 'created_at']);

            return Datatables::of($data)
            ->editColumn('created_at', function ($data) {
                if($data->created_at == null) {
                    // $data->created_at = '1/1/1900';
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


    public function DatatableInbox()
    {
        return view('dashboard.index');
    }
    public function CheckMail()
    {
        $data = DB::table('process_inbox')->join('inboxes', 'process_inbox.inboxes_id', '=', 'inboxes.id')
            ->select(['process_inbox.action', 'process_inbox.note', 'process_inbox.description', 'inboxes.name', 'process_inbox.created_at']);

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


                // Carbon::setLocale('vi');
                // return $data->created_at ? with(new Carbon($data->created_at))->diffForHumans() : '';
            })
            ->setRowAttr([
                'color' => 'red'
            ])

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
        // $previous_week = strtotime("-1 week +1 day");
        // $start_week = strtotime("last sunday midnight",$previous_week);
        // $end_week = strtotime("next saturday",$start_week);
        // $start_week = strtotime("this monday midnight",$previous_week);
        // $end_week = strtotime("next sunday midnight",$start_week);
        // $start_week = date("d-m-Y",$start_week);
        // $end_week = date("d-m-Y",$end_week);

        // $day = date('w');
        // $week_start = date('d-m-Y', strtotime('-'.$day.' days'));
        // $week_end = date('d-m-Y', strtotime('+'.(6-$day).' days'));
    //    $result = Inbox::select(['name', 'contact_id', 'size', 'path', 'created_at'])->whereDate('created_at', Carbon::today())->get();
        // $result = Inbox::select(['name', 'contact_id', 'size', 'path', 'created_at'])->whereBetween('created_at', [$start_week, $end_week])->get();
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

}
