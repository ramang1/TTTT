<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOutboxAPIRequest;
use App\Http\Requests\API\UpdateOutboxAPIRequest;
use App\Models\Outbox;
use App\Repositories\OutboxRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class OutboxController
 * @package App\Http\Controllers\API
 */

class OutboxAPIController extends AppBaseController
{
    /** @var  OutboxRepository */
    private $outboxRepository;

    public function __construct(OutboxRepository $outboxRepo)
    {
        $this->outboxRepository = $outboxRepo;
    }

    /**
     * Display a listing of the Outbox.
     * GET|HEAD /outboxes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $outboxes = $this->outboxRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );
        
        return $this->sendResponse($outboxes->toArray(), 'Outboxes retrieved successfully');
    }

    /**
     * Store a newly created Outbox in storage.
     * POST /outboxes
     *
     * @param CreateOutboxAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateOutboxAPIRequest $request)
    {
        $input = $request->all();

        $outbox = $this->outboxRepository->create($input);

        return $this->sendResponse($outbox->toArray(), 'Outbox saved successfully');
    }

    /**
     * Display the specified Outbox.
     * GET|HEAD /outboxes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Outbox $outbox */
        $outbox = $this->outboxRepository->find($id);

        if (empty($outbox)) {
            return $this->sendError('Outbox not found');
        }

        return $this->sendResponse($outbox->toArray(), 'Outbox retrieved successfully');
    }

    /**
     * Update the specified Outbox in storage.
     * PUT/PATCH /outboxes/{id}
     *
     * @param int $id
     * @param UpdateOutboxAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOutboxAPIRequest $request)
    {
        $input = $request->all();

        /** @var Outbox $outbox */
        $outbox = $this->outboxRepository->find($id);

        if (empty($outbox)) {
            return $this->sendError('Outbox not found');
        }

        $outbox = $this->outboxRepository->update($input, $id);

        return $this->sendResponse($outbox->toArray(), 'Outbox updated successfully');
    }

    /**
     * Remove the specified Outbox from storage.
     * DELETE /outboxes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Outbox $outbox */
        $outbox = $this->outboxRepository->find($id);

        if (empty($outbox)) {
            return $this->sendError('Outbox not found');
        }

        $outbox->delete();

        return $this->sendSuccess('Outbox deleted successfully');
    }
}
