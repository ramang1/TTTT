<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Repositories\BaseRepository;

/**
 * Class ContactRepository
 * @package App\Repositories
 * @version July 25, 2020, 2:21 pm UTC
*/

class ContactRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'name',
        'phone',
        'fax',
        'mobile',
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
        return Contact::class;
    }
}
