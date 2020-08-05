<?php

namespace App\Http\Controllers;

use App\DataTables\OutboxProcessDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOutboxProcessRequest;
use App\Http\Requests\UpdateOutboxProcessRequest;
use App\Repositories\OutboxProcessRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class OutboxProcessController extends AppBaseController
{
    /** @var  OutboxProcessRepository */
    private $outboxProcessRepository;

    public function __construct(OutboxProcessRepository $outboxProcessRepo)
    {
        $this->outboxProcessRepository = $outboxProcessRepo;
    }

    /**
     * Display a listing of the OutboxProcess.
     *
     * @param OutboxProcessDataTable $outboxProcessDataTable
     * @return Response
     */
    public function index(OutboxProcessDataTable $outboxProcessDataTable)
    {
        return $outboxProcessDataTable->render('outbox_processes.index');
    }

    /**
     * Show the form for creating a new OutboxProcess.
     *
     * @return Response
     */
    public function create()
    {
        return view('outbox_processes.create');
    }

    /**
     * Store a newly created OutboxProcess in storage.
     *
     * @param CreateOutboxProcessRequest $request
     *
     * @return Response
     */
    public function store(CreateOutboxProcessRequest $request)
    {
        $input = $request->all();

        $outboxProcess = $this->outboxProcessRepository->create($input);

        Flash::success('Outbox Process saved successfully.');

        return redirect(route('outboxProcesses.index'));
    }

    /**
     * Display the specified OutboxProcess.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $outboxProcess = $this->outboxProcessRepository->find($id);

        if (empty($outboxProcess)) {
            Flash::error('Outbox Process not found');

            return redirect(route('outboxProcesses.index'));
        }

        return view('outbox_processes.show')->with('outboxProcess', $outboxProcess);
    }

    /**
     * Show the form for editing the specified OutboxProcess.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $outboxProcess = $this->outboxProcessRepository->find($id);

        if (empty($outboxProcess)) {
            Flash::error('Outbox Process not found');

            return redirect(route('outboxProcesses.index'));
        }

        return view('outbox_processes.edit')->with('outboxProcess', $outboxProcess);
    }

    /**
     * Update the specified OutboxProcess in storage.
     *
     * @param  int              $id
     * @param UpdateOutboxProcessRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOutboxProcessRequest $request)
    {
        $outboxProcess = $this->outboxProcessRepository->find($id);

        if (empty($outboxProcess)) {
            Flash::error('Outbox Process not found');

            return redirect(route('outboxProcesses.index'));
        }

        $outboxProcess = $this->outboxProcessRepository->update($request->all(), $id);

        Flash::success('Outbox Process updated successfully.');

        return redirect(route('outboxProcesses.index'));
    }

    /**
     * Remove the specified OutboxProcess from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $outboxProcess = $this->outboxProcessRepository->find($id);

        if (empty($outboxProcess)) {
            Flash::error('Outbox Process not found');

            return redirect(route('outboxProcesses.index'));
        }

        $this->outboxProcessRepository->delete($id);

        Flash::success('Outbox Process deleted successfully.');

        return redirect(route('outboxProcesses.index'));
    }
}
