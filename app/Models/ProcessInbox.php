<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProcessInbox
 * @package App\Models
 * @version August 3, 2020, 9:54 am UTC
 *
 * @property \App\Models\Inbox $hash
 * @property \App\Models\User $id
 * @property string $action
 * @property string $inbox_hash
 * @property integer $user_id
 * @property string $note
 * @property string $description
 */
class ProcessInbox extends Model
{
    use SoftDeletes;

    public $table = 'process_inbox';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'action',
        'inbox_hash',
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
        'action' => 'string',
        'inbox_hash' => 'string',
        'user_id' => 'integer',
        'note' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function hash()
    {
        return $this->belongsTo(\App\Models\Inbox::class, 'hash', 'inbox_hash');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function id()
    {
        return $this->belongsTo(\App\Models\User::class, 'id', 'user_id');
    }
}
