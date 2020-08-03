<?php

namespace App\Http\Controllers;

use App\DataTables\ProcessInboxDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateProcessInboxRequest;
use App\Http\Requests\UpdateProcessInboxRequest;
use App\Repositories\ProcessInboxRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ProcessInboxController extends AppBaseController
{
    /** @var  ProcessInboxRepository */
    private $processInboxRepository;

    public function __construct(ProcessInboxRepository $processInboxRepo)
    {
        $this->processInboxRepository = $processInboxRepo;
    }

    /**
     * Display a listing of the ProcessInbox.
     *
     * @param ProcessInboxDataTable $processInboxDataTable
     * @return Response
     */
    public function index(ProcessInboxDataTable $processInboxDataTable)
    {
        return $processInboxDataTable->render('process_inboxes.index');
    }

    /**
     * Show the form for creating a new ProcessInbox.
     *
     * @return Response
     */
    public function create()
    {
        return view('process_inboxes.create');
    }

    /**
     * Store a newly created ProcessInbox in storage.
     *
     * @param CreateProcessInboxRequest $request
     *
     * @return Response
     */
    public function store(CreateProcessInboxRequest $request)
    {
        $input = $request->all();

        $processInbox = $this->processInboxRepository->create($input);

        Flash::success('Process Inbox saved successfully.');

        return redirect(route('processInboxes.index'));
    }

    /**
     * Display the specified ProcessInbox.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $processInbox = $this->processInboxRepository->find($id);

        if (empty($processInbox)) {
            Flash::error('Process Inbox not found');

            return redirect(route('processInboxes.index'));
        }

        return view('process_inboxes.show')->with('processInbox', $processInbox);
    }

    /**
     * Show the form for editing the specified ProcessInbox.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $processInbox = $this->processInboxRepository->find($id);

        if (empty($processInbox)) {
            Flash::error('Process Inbox not found');

            return redirect(route('processInboxes.index'));
        }

        return view('process_inboxes.edit')->with('processInbox', $processInbox);
    }

    /**
     * Update the specified ProcessInbox in storage.
     *
     * @param  int              $id
     * @param UpdateProcessInboxRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProcessInboxRequest $request)
    {
        $processInbox = $this->processInboxRepository->find($id);

        if (empty($processInbox)) {
            Flash::error('Process Inbox not found');

            return redirect(route('processInboxes.index'));
        }

        $processInbox = $this->processInboxRepository->update($request->all(), $id);

        Flash::success('Process Inbox updated successfully.');

        return redirect(route('processInboxes.index'));
    }

    /**
     * Remove the specified ProcessInbox from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $processInbox = $this->processInboxRepository->find($id);

        if (empty($processInbox)) {
            Flash::error('Process Inbox not found');

            return redirect(route('processInboxes.index'));
        }

        $this->processInboxRepository->delete($id);

        Flash::success('Process Inbox deleted successfully.');

        return redirect(route('processInboxes.index'));
    }
}
