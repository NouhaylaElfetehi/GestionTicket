<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'nom', 'prenom', 'genre', 'adresse', 'telephone'
    ];

    public function Achats(){
        return $this->hasMany('App\Achat');
    }

    /*
    public function User(){
        return $this->belongsTo('App\User');
    }*/

}
