<?php

namespace App\Repositories;

use App\Models\ProcessInbox;
use App\Repositories\BaseRepository;

/**
 * Class ProcessInboxRepository
 * @package App\Repositories
 * @version August 3, 2020, 9:54 am UTC
*/

class ProcessInboxRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'process_type',
        'inbox_hash',
        'user_id',
        'note',
        'description'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ProcessInbox::class;
    }
}
