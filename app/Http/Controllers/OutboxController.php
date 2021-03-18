<?php

namespace App\Http\Controllers;

use App\DataTables\OutboxDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOutboxRequest;
use App\Http\Requests\UpdateOutboxRequest;
use App\Repositories\OutboxRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\Contact;
use App\Models\Channel;
use App\Models\Users;
use Yajra\DataTables\DataTables;
use App\Models\Outbox;
use Illuminate\Support\Str;

//use Request;
use DB;
use Carbon\Carbon;
use Log;
use Illuminate\Http\Request;

class OutboxController extends AppBaseController
{
    /** @var  OutboxRepository */
    private $outboxRepository;

    public function __construct(OutboxRepository $outboxRepo)
    {
        $this->outboxRepository = $outboxRepo;
    }

    /**
     * Display a listing of the Outbox.
     *
     * @param OutboxDataTable $outboxDataTable
     * @return Response
     */
    public function index(OutboxDataTable $outboxDataTable)
    {
        //return $outboxDataTable->render('outboxes.index');
        return view('outboxes.index');
    }

    ///
    public function data(Request $request)
    {
        $startDate = 0;
        $endDate = 0;

        if ($request->has('startDate') && $request->has('endDate')) {
            $startDate = $request->startDate;
            $endDate = $request->endDate;
        }
        $isUnsend = false;
        if (Str::endsWith($request->url, '/unsends')) $isUnsend = true;
        $data = DB::table('outboxes')->whereNull('deleted_at');
        if ($isUnsend == true) {
            $data = Outbox::whereNotIn('id', function ($process_hash) {
                $process_hash
                    ->select('id')
                    ->from('outbox_process')
                    ->whereNull('deleted_at')
                    ->where('action_type', '=', 'nen_zip')
                    ->orWhere('action_type', '=', 'nen_rar');
            });
        }
        if ($startDate == 0 && $endDate == 0) {
        } else {
            $startDate = $startDate . ' 00:00:00';
            $startDate = \Carbon\Carbon::parse($startDate)->format('Y-m-d H:i:s');

            $endDate = $endDate . ' 23:59:59';
            $endDate = \Carbon\Carbon::parse($endDate)->format('Y-m-d H:i:s');


            $data = $data->whereBetween('created_at', [$startDate, $endDate]);
        }
        Log::info('outbox data ' . $startDate . ' den ' . $endDate);
        //->orderBy('created_at','desc');

        return Datatables::of($data)
            ->editColumn('created_at', function ($data) {
                if ($data->created_at == null) {
                    return $data->created_at ?: 'Unknown';
                }
                Carbon::setLocale('vi');
                return $data->created_at ? with(new Carbon($data->created_at))->diffForHumans() : '';
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%m/%d/%Y') like ?", ["%$keyword%"]);
            })
            ->editColumn(
                'channel_id',
                function ($data) {
                    $idChannel = $data->channel_id;
                    $Channel = Channel::where('id', '=', $idChannel)->pluck('name');
                    if ($Channel->isEmpty()) {
                        return 'Unknown';
                    }
                    return $Channel[0];
                }
            )
            ->editColumn(
                'user_id',
                function ($data) {
                    $idUser = $data->user_id;
                    $User = DB::table('users')->where('id', '=', $idUser)->pluck('name');
                    if ($User->isEmpty()) {
                        return 'Unknown';
                    }
                    return $User[0];
                }
            )
            ->editColumn(
                'contact_id',
                function ($data) {

                    $ContactUser = $data->contact_id;

                    $Contact = Contact::where('id', '=', $ContactUser)->pluck('name');

                    if ($Contact->isEmpty()) {
                        return 'Unknown';
                    }
                    return $Contact[0];
                }
            )

            ->addColumn('action', 'outboxes.datatables_actions')
            ->make(true);
    }

    /**
     * Show the form for creating a new Outbox.
     *
     * @return Response
     */
    public function create()
    {
        return view('outboxes.create');
    }

    /**
     * Store a newly created Outbox in storage.
     *
     * @param CreateOutboxRequest $request
     *
     * @return Response
     */
    public function store(CreateOutboxRequest $request)
    {
        $input = $request->all();

        $outbox = $this->outboxRepository->create($input);

        Flash::success('Outbox saved successfully.');

        return redirect(route('outboxes.index'));
    }

    /**
     * Display the actions of Outbox.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function actions($id)
    {
        $data = DB::table('outbox_process')
            ->whereNull('deleted_at')
            ->where('outbox_id', '=', $id);
            // ->orderBy('created_at', 'desc');
        return Datatables::of($data)
        ->editColumn('user_id', function ($resultUser) {
            $idUser = $resultUser->user_id;
            $User = \App\User::where('id', '=', $idUser)->pluck('name');
            // return $nameID->name;
            return $User[0];
        })
            //->addColumn('action', 'inboxes.datatables_actions')
            ->make(true);
    }


    /**
     * Display the specified Outbox.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $outbox = $this->outboxRepository->find($id);

        if (empty($outbox)) {
            Flash::error('Outbox not found');

            return redirect(route('outboxes.index'));
        }

        return view('outboxes.show')->with('outbox', $outbox);
    }

    /**
     * Show the form for editing the specified Outbox.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $outbox = $this->outboxRepository->find($id);

        if (empty($outbox)) {
            Flash::error('Outbox not found');

            return redirect(route('outboxes.index'));
        }

        return view('outboxes.edit')->with('outbox', $outbox);
    }

    /**
     * Update the specified Outbox in storage.
     *
     * @param  int              $id
     * @param UpdateOutboxRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOutboxRequest $request)
    {
        $outbox = $this->outboxRepository->find($id);

        if (empty($outbox)) {
            Flash::error('Outbox not found');

            return redirect(route('outboxes.index'));
        }

        $outbox = $this->outboxRepository->update($request->all(), $id);

        Flash::success('Outbox updated successfully.');

        return redirect(route('outboxes.index'));
    }

    /**
     * Remove the specified Outbox from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $outbox = $this->outboxRepository->find($id);

        if (empty($outbox)) {
            Flash::error('Outbox not found');

            return redirect(route('outboxes.index'));
        }

        $this->outboxRepository->delete($id);

        Flash::success('Outbox deleted successfully.');

        return redirect(route('outboxes.index'));
    }

    // Ham thu chua gui

    public function outbox_unsend()
    {
        $contacts = Contact::all();
        // $data = DB::table('inboxes')->get();
        $totalUnsend_outbox = Outbox::whereNotIn('id', function ($process_hash) {
            $process_hash
                ->select('id')
                ->from('outbox_process')
                ->whereNull('deleted_at')
                ->where('action_type', '=', 'nen_zip')
                ->orWhere('action_type', '=', 'nen_rar');
        })->get();

        return view('outboxes.unsend')->with('contacts', $contacts)->with('totalUnsend_outbox', $totalUnsend_outbox);
    }
    public function unsenddata(Request $request)
    {
        $result1 = Outbox::select(['name', 'id', 'path', 'size', 'type', 'channel_id', 'created_at']);
        return Datatables::of($result1)
            ->editColumn('created_at', function ($result11) {
                if ($result11->created_at == null) {
                    return $result11->created_at ?: 'Unknown';
                }
                Carbon::setLocale('vi');
                return $result11->created_at->format('d-m-Y - H:i:s');
            })
            ->make(true);
    }

    public function unsenddata1(Request $request)
    {
        $result2 = Outbox::select(['name', 'id', 'path', 'size', 'type', 'channel_id', 'created_at'])->whereDate('created_at', Carbon::today())->get();
        return Datatables::of($result2)
            ->editColumn('created_at', function ($result22) {

                Carbon::setLocale('vi');
                return $result22->created_at->format('d-m-Y - H:i:s');
            })
            ->make(true);
    }

    public function unsenddata2(Request $request)
    {
        $result3 = Outbox::select(['name', 'id', 'path', 'size', 'type', 'channel_id', 'created_at'])->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        return Datatables::of($result3)
            ->editColumn('created_at', function ($result33) {

                Carbon::setLocale('vi');
                return $result33->created_at->format('d-m-Y - H:i:s');
            })
            ->make(true);
    }

    public function unsenddata3(Request $request)
    {
        $result4 = Outbox::select(['name', 'id', 'path', 'size', 'type', 'channel_id', 'created_at'])->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
        return Datatables::of($result4)
            ->editColumn('created_at', function ($result44) {

                Carbon::setLocale('vi');
                return $result44->created_at->format('d-m-Y - H:i:s');
            })
            ->make(true);
    }

    public function unsenddata4(Request $request)
    {
        $result5 = Outbox::select(['name', 'id', 'path', 'size', 'type', 'channel_id', 'created_at'])->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();
        return Datatables::of($result5)
            ->editColumn('created_at', function ($result55) {

                Carbon::setLocale('vi');
                return $result55->created_at->format('d-m-Y - H:i:s');
            })
            ->make(true);
    }



    // Viet ham cho box so 1 - outboxTotal
    public function outboxTotal()
    {
        $contacts = Contact::all();

        return view('outboxes.outboxTotal')->with('contacts', $contacts);
    }


    // tong thu den box 2 - tab so 1
    public function getdataoutboxTotal(Request $request)
    {
        $result_box1 = Outbox::select(['name', 'id', 'size', 'path', 'type', 'channel_id', 'user_id', 'created_at']);
        return Datatables::of($result_box1)
            ->editColumn('created_at', function ($result11) {
                if ($result11->created_at == null) {
                    return $result11->created_at ?: 'Unknown';
                }
                Carbon::setLocale('vi');
                return $result11->created_at->format('d-m-Y - H:i:s');
                //? with(new Carbon($data->created_at))->diffForHumans() : '';
            })
            ->editColumn(
                'channel_id',
                function ($resultChannel) {
                    $idGroup = $resultChannel->channel_id;
                    $nameGroup = \App\Models\Channel::where('id', '=', $idGroup)->pluck('name');
                    return $nameGroup[0];
                }
            )
            ->editColumn('user_id', function ($resultUser) {
                $idUser = $resultUser->user_id;
                $User = \App\User::where('id', '=', $idUser)->pluck('name');
                // return $nameID->name;
                return $User[0];
            })
            ->make(true);
        // }
    }

    // tong thu den box 2 - tab so 2
    public function getdataoutboxTotal1(Request $request)
    {
        $result_box1_tab2 = Outbox::select(['name', 'id', 'size', 'path', 'type', 'channel_id', 'user_id', 'created_at'])->whereDate('created_at', Carbon::today())->get();

        return Datatables::of($result_box1_tab2)
            ->editColumn(
                'created_at',
                function ($result12) {
                    Carbon::setLocale('vi');
                    return $result12->created_at->format('d-m-Y - H:i:s');
                }
            )
            ->editColumn(
                'channel_id',
                function ($resultChannel) {
                    $idGroup = $resultChannel->channel_id;
                    $nameGroup = \App\Models\Channel::where('id', '=', $idGroup)->pluck('name');
                    return $nameGroup[0];
                }
            )
            ->editColumn('user_id', function ($resultUser) {
                $idUser = $resultUser->user_id;
                $User = \App\User::where('id', '=', $idUser)->pluck('name');
                // return $nameID->name;
                return $User[0];
            })
            ->make(true);
    }

    // tong thu den box 2 - tab so 3
    public function getdataoutboxTotal2(Request $request)
    {
        $result_box1_tab3 = Outbox::select(['name', 'id', 'size', 'path', 'type', 'channel_id', 'user_id', 'created_at'])->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();

        return Datatables::of($result_box1_tab3)
            ->editColumn(
                'created_at',
                function ($result13) {
                    Carbon::setLocale('vi');
                    return $result13->created_at->format('d-m-Y - H:i:s');
                }
            )
            ->editColumn(
                'channel_id',
                function ($resultChannel) {
                    $idGroup = $resultChannel->channel_id;
                    $nameGroup = \App\Models\Channel::where('id', '=', $idGroup)->pluck('name');
                    return $nameGroup[0];
                }
            )
            ->editColumn('user_id', function ($resultUser) {
                $idUser = $resultUser->user_id;
                $User = \App\User::where('id', '=', $idUser)->pluck('name');
                // return $nameID->name;
                return $User[0];
            })
            ->make(true);
    }

    // tong thu den box 2 - tab so 4
    public function getdataoutboxTotal3(Request $request)
    {
        $result_box1_tab4 = Outbox::select(['name', 'id', 'size', 'path', 'type', 'channel_id', 'user_id', 'created_at'])->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();

        return Datatables::of($result_box1_tab4)
            ->editColumn(
                'created_at',
                function ($result14) {
                    Carbon::setLocale('vi');
                    return $result14->created_at->format('d-m-Y - H:i:s');
                }
            )
            ->editColumn(
                'channel_id',
                function ($resultChannel) {
                    $idGroup = $resultChannel->channel_id;
                    $nameGroup = \App\Models\Channel::where('id', '=', $idGroup)->pluck('name');
                    return $nameGroup[0];
                }
            )
            ->editColumn('user_id', function ($resultUser) {
                $idUser = $resultUser->user_id;
                $User = \App\User::where('id', '=', $idUser)->pluck('name');
                // return $nameID->name;
                return $User[0];
            })
            ->make(true);
    }

    // tong thu den box 2 - tab so 5
    public function getdataoutboxTotal4(Request $request)
    {
        $result_box1_tab5 = Outbox::select(['name', 'id', 'size', 'path', 'type', 'channel_id', 'user_id', 'created_at'])->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->get();

        return Datatables::of($result_box1_tab5)
            ->editColumn(
                'created_at',
                function ($result15) {
                    Carbon::setLocale('vi');
                    return $result15->created_at->format('d-m-Y - H:i:s');
                }
            )
            ->editColumn(
                'channel_id',
                function ($resultChannel) {
                    $idGroup = $resultChannel->channel_id;
                    $nameGroup = \App\Models\Channel::where('id', '=', $idGroup)->pluck('name');
                    return $nameGroup[0];
                }
            )
            ->editColumn('user_id', function ($resultUser) {
                $idUser = $resultUser->user_id;
                $User = \App\User::where('id', '=', $idUser)->pluck('name');
                // return $nameID->name;
                return $User[0];
            })
            ->make(true);
    }

    // Outbox THU DI
}
