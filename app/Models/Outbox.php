<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Outbox
 * @package App\Models
 * @version August 5, 2020, 2:16 am UTC
 *
 * @property string $has
 * @property string $name
 * @property string $path
 * @property string $size
 * @property integer $type
 * @property integer $contact_id
 */
class Outbox extends Model
{
    use SoftDeletes;

    public $table = 'outboxes';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'hash',
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
        'type' => 'enum',
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
