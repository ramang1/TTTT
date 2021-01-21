<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Service
 * @package App\Models
 * @version January 21, 2021, 12:37 am -03
 *
 * @property string $name
 * @property boolean $status
 * @property string $note
 * @property string $path
 */
class Service extends Model
{

    public $table = 'services';
    



    public $fillable = [
        'name',
        'status',
        'note',
        'path'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'status' => 'boolean',
        'note' => 'string',
        'path' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
