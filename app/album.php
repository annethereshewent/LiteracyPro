<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class album extends Model
{
    protected $table = 'album';

    public $timestamps = false;

    function band() {
    	return $this->belongsTo('App\band');
    }
}
