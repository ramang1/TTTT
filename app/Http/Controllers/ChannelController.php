<?php

namespace App\Http\Controllers;

use App\DataTables\ChannelDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateChannelRequest;
use App\Http\Requests\UpdateChannelRequest;
use App\Repositories\ChannelRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Libraries\General;
use App\Contact;
use App\ChannelContact;
use Response;

class ChannelController extends AppBaseController
{
    /** @var  ChannelRepository */
    private $channelRepository;

    public function __construct(ChannelRepository $channelRepo)
    {
        $this->channelRepository = $channelRepo;
    }

    /**
     * Display a listing of the Channel.
     *
     * @param ChannelDataTable $channelDataTable
     * @return Response
     */
    public function index(ChannelDataTable $channelDataTable)
    {
        return $channelDataTable->render('channels.index');
    }

    /**
     * Show the form for creating a new Channel.
     *
     * @return Response
     */
    public function create()
    {
       
        $types = General::getEnumValues('channels', 'type');       
        $contacts = Contact::orderBy('code', 'asc')->get();
       
        return view('channels.create', ['contacts' => $contacts, 'types' => $types]);

    }

    /**
     * Store a newly created Channel in storage.
     *
     * @param CreateChannelRequest $request
     *
     * @return Response
     */
    public function store(CreateChannelRequest $request)
    {
        $input = $request->all();
        $channel = $this->channelRepository->create($input);
        
        $contacts = $input['contacts'];
        // foreach ($contacts as $contact) {
           
        //         ChannelContact::create([
        //             'channel_id' => $channel->id,
        //             'contact_id' => $contact
        //         ]);
        
        // }

        $channel->contacts()->attach($contacts);

       // dd($channel_contact);
        

        
        Flash::success('Lưu tuyến thành công!!!.');
       
        return redirect(route('channels.index'));
    }

    /**
     * Display the specified Channel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $channel = $this->channelRepository->find($id);

        if (empty($channel)) {
            Flash::error('Channel not found');

            return redirect(route('channels.index'));
        }

        return view('channels.show')->with('channel', $channel);
    }

    /**
     * Show the form for editing the specified Channel.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $channel = $this->channelRepository->find($id);
        
        if (empty($channel)) {
            Flash::error('Channel not found');

            return redirect(route('channels.index'));
        }

        return view('channels.edit')->with('channel', $channel);
    }

    /**
     * Update the specified Channel in storage.
     *
     * @param  int              $id
     * @param UpdateChannelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateChannelRequest $request)
    {
        $channel = $this->channelRepository->find($id);

        if (empty($channel)) {
            Flash::error('Channel not found');

            return redirect(route('channels.index'));
        }

        $channel = $this->channelRepository->update($request->all(), $id);

        Flash::success('Channel updated successfully.');

        return redirect(route('channels.index'));
    }

    /**
     * Remove the specified Channel from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $channel = $this->channelRepository->find($id);

        if (empty($channel)) {
            Flash::error('Channel not found');

            return redirect(route('channels.index'));
        }

        $this->channelRepository->delete($id);

        Flash::success('Channel deleted successfully.');

        return redirect(route('channels.index'));
    }
}
