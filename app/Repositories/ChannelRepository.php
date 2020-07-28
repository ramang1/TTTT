<?php

namespace App\Repositories;

use App\Models\Channel;
use App\Repositories\BaseRepository;

/**
 * Class ChannelRepository
 * @package App\Repositories
 * @version July 26, 2020, 3:32 am UTC
*/

class ChannelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'name',
        'type',
        'note'
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
        return Channel::class;
    }
}
