<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Channel;
class Contact extends Model
{
    //
    //protected $table = 'contacts';
    public function channels()
    { 
         return $this->belongsToMany('App\ChannelContact');
    }
}           