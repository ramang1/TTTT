<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Contact
 * @package App\Models
 * @version July 25, 2020, 2:21 pm UTC
 *
 * @property string $code
 * @property string $name
 * @property string $phone
 * @property string $fax
 * @property string $mobile
 * @property string $note
 */
class Contact extends Model
{
    use SoftDeletes;

    public $table = 'contacts';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'code',
        'name',
        'phone',
        'fax',
        'mobile',
        'note'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'note' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
