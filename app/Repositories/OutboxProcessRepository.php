<?php

namespace App\Repositories;

use App\Models\OutboxProcess;
use App\Repositories\BaseRepository;

/**
 * Class OutboxProcessRepository
 * @package App\Repositories
 * @version August 5, 2020, 2:32 am UTC
*/

class OutboxProcessRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'action',
        'outbox_id',
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
        return OutboxProcess::class;
    }
}
