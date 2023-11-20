<?php

namespace App\Http\Controllers;

use App\Achat;
use App\Http\Resources\AchatCollection;
use Illuminate\Http\Request;

class AchatController extends Controller
{

    //lister les clients
    public function index(){
        return new AchatCollection(Achat::with('client')->get());
    }

    //Afficher le formulaire de craetion d'un client
    public function create(){

    }

    //enregistrer un cv
    public function store(Request $request){
        $achat = new Achat([
            'client_id' => $request->get('client_id'),
            'type' => $request->get('type'),
            'quantite' => $request->get('quantite'),
            'date_achat' => $request->get('date_achat'),
            'date_expiration' => $request->get('date_expiration'),
        ]);

        $achat->save();

        return response()->json('successfully added');
    }

    public function edit($id)
    {
        $achat = Achat::find($id);
        return response()->json($achat);
    }

    public function update($id, Request $request)
    {
        $achat = Achat::find($id);

        $achat->update($request->all());

        return response()->json('successfully updated');
    }



    public function delete($id)
    {
        $achat = Achat::find($id);

        $achat->delete();
        foreach ($achat->tickets as $ticket){
            $ticket->delete();
        }

        return response()->json('successfully deleted');
    }
}
