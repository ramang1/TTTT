<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProcessInboxAPIRequest;
use App\Http\Requests\API\UpdateProcessInboxAPIRequest;
use App\Models\ProcessInbox;
use App\Repositories\ProcessInboxRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ProcessInboxController
 * @package App\Http\Controllers\API
 */

class ProcessInboxAPIController extends AppBaseController
{
    /** @var  ProcessInboxRepository */
    private $processInboxRepository;

    public function __construct(ProcessInboxRepository $processInboxRepo)
    {
        $this->processInboxRepository = $processInboxRepo;
    }

    /**
     * Display a listing of the ProcessInbox.
     * GET|HEAD /processInboxes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $processInboxes = $this->processInboxRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($processInboxes->toArray(), 'Process Inboxes retrieved successfully');
    }

    /**
     * Store a newly created ProcessInbox in storage.
     * POST /processInboxes
     *
     * @param CreateProcessInboxAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProcessInboxAPIRequest $request)
    {
        $input = $request->all();

        $processInbox = $this->processInboxRepository->create($input);

        return $this->sendResponse($processInbox->toArray(), 'Process Inbox saved successfully');
    }

    /**
     * Display the specified ProcessInbox.
     * GET|HEAD /processInboxes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ProcessInbox $processInbox */
        $processInbox = $this->processInboxRepository->find($id);

        if (empty($processInbox)) {
            return $this->sendError('Process Inbox not found');
        }

        return $this->sendResponse($processInbox->toArray(), 'Process Inbox retrieved successfully');
    }

    /**
     * Update the specified ProcessInbox in storage.
     * PUT/PATCH /processInboxes/{id}
     *
     * @param int $id
     * @param UpdateProcessInboxAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProcessInboxAPIRequest $request)
    {
        $input = $request->all();

        /** @var ProcessInbox $processInbox */
        $processInbox = $this->processInboxRepository->find($id);

        if (empty($processInbox)) {
            return $this->sendError('Process Inbox not found');
        }

        $processInbox = $this->processInboxRepository->update($input, $id);

        return $this->sendResponse($processInbox->toArray(), 'ProcessInbox updated successfully');
    }

    /**
     * Remove the specified ProcessInbox from storage.
     * DELETE /processInboxes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ProcessInbox $processInbox */
        $processInbox = $this->processInboxRepository->find($id);

        if (empty($processInbox)) {
            return $this->sendError('Process Inbox not found');
        }

        $processInbox->delete();

        return $this->sendSuccess('Process Inbox deleted successfully');
    }
}
