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
        return $outboxDataTable->render('outboxes.index');
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
}
