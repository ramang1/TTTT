<?php

namespace App\Http\Controllers;

use App\DataTables\InboxDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateInboxRequest;
use App\Http\Requests\UpdateInboxRequest;
use App\Repositories\InboxRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\Contact;
use App\Models\Inbox;

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
    public function inboxes_unread()
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
}
