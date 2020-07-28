<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChannelContact extends Model
{
   
    //
    public $table = "channel_contact";
    protected $fillable = [
        'id',
        'channel_id',
        'contact_id', 
        
    ];
    public function contact()
    {
        return $this->belongsTo('App\Contact');
    }
    public function channel()
    {
        return $this->belongsTo('App\Channel');
    }

}
