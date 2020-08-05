<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOutboxProcessAPIRequest;
use App\Http\Requests\API\UpdateOutboxProcessAPIRequest;
use App\Models\OutboxProcess;
use App\Repositories\OutboxProcessRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class OutboxProcessController
 * @package App\Http\Controllers\API
 */

class OutboxProcessAPIController extends AppBaseController
{
    /** @var  OutboxProcessRepository */
    private $outboxProcessRepository;

    public function __construct(OutboxProcessRepository $outboxProcessRepo)
    {
        $this->outboxProcessRepository = $outboxProcessRepo;
    }

    /**
     * Display a listing of the OutboxProcess.
     * GET|HEAD /outboxProcesses
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $outboxProcesses = $this->outboxProcessRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($outboxProcesses->toArray(), 'Outbox Processes retrieved successfully');
    }

    /**
     * Store a newly created OutboxProcess in storage.
     * POST /outboxProcesses
     *
     * @param CreateOutboxProcessAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateOutboxProcessAPIRequest $request)
    {
        $input = $request->all();

        $outboxProcess = $this->outboxProcessRepository->create($input);

        return $this->sendResponse($outboxProcess->toArray(), 'Outbox Process saved successfully');
    }

    /**
     * Display the specified OutboxProcess.
     * GET|HEAD /outboxProcesses/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var OutboxProcess $outboxProcess */
        $outboxProcess = $this->outboxProcessRepository->find($id);

        if (empty($outboxProcess)) {
            return $this->sendError('Outbox Process not found');
        }

        return $this->sendResponse($outboxProcess->toArray(), 'Outbox Process retrieved successfully');
    }

    /**
     * Update the specified OutboxProcess in storage.
     * PUT/PATCH /outboxProcesses/{id}
     *
     * @param int $id
     * @param UpdateOutboxProcessAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOutboxProcessAPIRequest $request)
    {
        $input = $request->all();

        /** @var OutboxProcess $outboxProcess */
        $outboxProcess = $this->outboxProcessRepository->find($id);

        if (empty($outboxProcess)) {
            return $this->sendError('Outbox Process not found');
        }

        $outboxProcess = $this->outboxProcessRepository->update($input, $id);

        return $this->sendResponse($outboxProcess->toArray(), 'OutboxProcess updated successfully');
    }

    /**
     * Remove the specified OutboxProcess from storage.
     * DELETE /outboxProcesses/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var OutboxProcess $outboxProcess */
        $outboxProcess = $this->outboxProcessRepository->find($id);

        if (empty($outboxProcess)) {
            return $this->sendError('Outbox Process not found');
        }

        $outboxProcess->delete();

        return $this->sendSuccess('Outbox Process deleted successfully');
    }
}
