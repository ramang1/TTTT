<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateInboxAPIRequest;
use App\Http\Requests\API\UpdateInboxAPIRequest;
use App\Models\Inbox;
use App\Repositories\InboxRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class InboxController
 * @package App\Http\Controllers\API
 */

class InboxAPIController extends AppBaseController
{
    /** @var  InboxRepository */
    private $inboxRepository;

    public function __construct(InboxRepository $inboxRepo)
    {
        $this->inboxRepository = $inboxRepo;
    }

    /**
     * Display a listing of the Inbox.
     * GET|HEAD /inboxes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $inboxes = $this->inboxRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($inboxes->toArray(), 'Inboxes retrieved successfully');
    }

    /**
     * Store a newly created Inbox in storage.
     * POST /inboxes
     *
     * @param CreateInboxAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateInboxAPIRequest $request)
    {
        $input = $request->all();

        $inbox = $this->inboxRepository->create($input);

        return $this->sendResponse($inbox->toArray(), 'Inbox saved successfully');
    }

    /**
     * Display the specified Inbox.
     * GET|HEAD /inboxes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Inbox $inbox */
        $inbox = $this->inboxRepository->find($id);

        if (empty($inbox)) {
            return $this->sendError('Inbox not found');
        }

        return $this->sendResponse($inbox->toArray(), 'Inbox retrieved successfully');
    }

    /**
     * Update the specified Inbox in storage.
     * PUT/PATCH /inboxes/{id}
     *
     * @param int $id
     * @param UpdateInboxAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInboxAPIRequest $request)
    {
        $input = $request->all();

        /** @var Inbox $inbox */
        $inbox = $this->inboxRepository->find($id);

        if (empty($inbox)) {
            return $this->sendError('Inbox not found');
        }

        $inbox = $this->inboxRepository->update($input, $id);

        return $this->sendResponse($inbox->toArray(), 'Inbox updated successfully');
    }

    /**
     * Remove the specified Inbox from storage.
     * DELETE /inboxes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Inbox $inbox */
        $inbox = $this->inboxRepository->find($id);

        if (empty($inbox)) {
            return $this->sendError('Inbox not found');
        }

        $inbox->delete();

        return $this->sendSuccess('Inbox deleted successfully');
    }
}
