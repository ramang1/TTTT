<?php

namespace App\Repositories;

use App\Models\Outbox;
use App\Repositories\BaseRepository;

/**
 * Class OutboxRepository
 * @package App\Repositories
 * @version August 5, 2020, 2:16 am UTC
*/

class OutboxRepository extends BaseRepository
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
        return Outbox::class;
    }
}
