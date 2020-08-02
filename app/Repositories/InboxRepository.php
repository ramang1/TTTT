<?php

namespace App\Repositories;

use App\Models\Inbox;
use App\Repositories\BaseRepository;

/**
 * Class InboxRepository
 * @package App\Repositories
 * @version August 1, 2020, 9:12 am UTC
*/

class InboxRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'path',
        'size',
        'type',
        'contact_id'
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
        return Inbox::class;
    }
}
