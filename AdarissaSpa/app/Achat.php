<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    protected $fillable = [
        'client_id', 'type', 'quantite','date_achat','date_expiration'
    ];

    public function client(){
        return $this->belongsTo('App\Client');
    }

    public function tickets(){
        return $this->hasMany('App\Ticket');
    }
}
