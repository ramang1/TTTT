<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Contact;

/**
 * Class Channel
 * @package App\Models
 * @version July 26, 2020, 3:32 am UTC
 *
 * @property string $code
 * @property string $name
 * @property integer $type
 * @property string $note
 */
class Channel extends Model
{
    use SoftDeletes;

    public $table = 'channels';
    public function contacts()
    {
        return $this->belongsToMany(Contact::class);
    }

    protected $dates = ['deleted_at'];



    public $fillable = [
        
        'code',
        'name',
        'type',
        'note'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'name' => 'string',
        'type' => 'enum',
        'note' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'code' => 'required|unique:channels',
        'name' => 'required|unique:channels,name',
        'type' => 'required',
        'contacts' => 'required',
    ];

    
}
