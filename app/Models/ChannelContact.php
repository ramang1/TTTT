<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ChannelContact extends Model
{
   
    //
    //use SoftDeletes;
    public $table = "channel_contact";
    protected $fillable = [
        'id',
        'channel_id',
        'contact_id', 
        
    ];
    public function contact()
    {
        return $this->belongsTo('App\Models\Contact');
    }
    public function channel()
    {
        return $this->belongsTo('App\Models\Channel');
    }

}
