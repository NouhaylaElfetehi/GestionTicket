<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $primaryKey = "n_serie";
    protected $table = 'tickets';
    protected $casts = [
        'etat' => 'boolean',
    ];
    protected $fillable = [
        'n_serie', 'achat_id', 'prix', 'etat','date_consommation'
    ];

    public function achat(){
        return $this->belongsTo('App\Achat');
    }
}
