<?php

namespace App\Http\Controllers;


use App\Achat;
use App\Http\Resources\TicketCollection;
use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //lister les clients
    public function index(){
        return new TicketCollection(Ticket::with('achat')->get());
    }

    //Afficher le formulaire de craetion d'un client
    public function create(){

    }

    //enregistrer un cv
    public function store(Request $request){
        $achat = Achat::all()->last();
        $ticket = new Ticket([
            'achat_id' => $achat->id,
            'prix' => $request->get('prix'),
            'etat' => false,
            'date_consommation' => null,
        ]);

        $ticket->save();

        return response()->json('successfully added');
    }

    public function edit($n_serie)
    {
        $ticket = Ticket::find($n_serie);
        return response()->json($ticket);
    }

    public function update($n_serie, Request $request)
    {
        $ticket = Ticket::find($n_serie);

        $ticket->update($request->all());

        return response()->json('successfully updated');
    }



    public function delete($n_serie)
    {

        $ticket = Ticket::find($n_serie);
        //dd($ticket);
        if($ticket != null){
            $achat = Achat::find($ticket->achat_id);
            $achat->quantite = $achat->quantite - 1;
            if($achat->quantite == 0){
                $achat->delete();
            }else{
                $achat->update();
            }
        }

        $ticket->delete();

        return response()->json('successfully deleted');
    }

    public function check($n_serie)
    {
        $ticket = Ticket::find($n_serie);
        $ticket->etat = true;
        $ticket->date_consommation = now();

        $ticket->save();

        return response()->json('successfully updated');
    }
}
