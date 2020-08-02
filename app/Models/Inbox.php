<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Inbox
 * @package App\Models
 * @version August 1, 2020, 9:12 am UTC
 *
 * @property string $name
 * @property string $path
 * @property string $size
 * @property integer $type
 * @property integer $contact_id
 */
class Inbox extends Model
{
    use SoftDeletes;

    public $table = 'inboxes';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'path',
        'size',
        'type',
        'contact_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'hash' => 'string',
        'name' => 'string',
        'path' => 'string',
        'size' => 'string',
        'type' => 'integer',
        'contact_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
