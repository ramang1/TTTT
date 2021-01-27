<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OutboxProcess
 * @package App\Models
 * @version August 5, 2020, 2:32 am UTC
 *
 * @property integer $action
 * @property string $outbox_hash
 * @property integer $user_id
 * @property string $note
 * @property integer $description
 */
class OutboxProcess extends Model
{
    use SoftDeletes;

    public $table = 'outbox_process';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'action',
        'outbox_id',
        'user_id',
        'note',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'action' => 'integer',
        'outbox_hash' => 'string',
        'user_id' => 'integer',
        'note' => 'string',
        'description' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
