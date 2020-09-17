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
            ->make(true);
    }
}
//  git config --global user.email "you@example.com"
//   git config --global user.name "TuanAnh"
