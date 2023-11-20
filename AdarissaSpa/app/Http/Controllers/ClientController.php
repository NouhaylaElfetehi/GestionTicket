<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientCollection;
use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //lister les clients
    public function index(){
        return new ClientCollection(Client::all());
    }

    //Afficher le formulaire de craetion d'un client
    public function create(){

    }

    //enregistrer un cv
    public function store(Request $request){
        $client = new Client([
            'nom' => $request->get('nom'),
            'prenom' => $request->get('prenom'),
            'genre' => $request->get('genre'),
            'adresse' => $request->get('adresse'),
            'telephone' => $request->get('telephone'),
        ]);

        $client->save();

        return response()->json('successfully added');
    }

    public function edit($id)
    {
        $client = Client::find($id);
        return response()->json($client);
    }

    public function update($id, Request $request)
    {
        $client = Client::find($id);

        $client->update($request->all());

        return response()->json('successfully updated');
    }



    public function delete($id)
    {
        $client = Client::find($id);

        $client->delete();

        return response()->json('successfully deleted');
    }
}
