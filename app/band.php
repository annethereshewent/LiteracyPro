<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class band extends Model
{
    protected $table = 'band';

    public $timestamps = false;

    public function albums() {
    	return $this->hasMany('App\album');
    }
}
