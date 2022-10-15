<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Mostrar;
use App\Models\Reserva;
use App\Models\Restaurante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class reservaController extends Controller
{
    public $estados = ["pendiente", "cancelado", "em servicio", "servido", "no presentado"];

    public function vistaReserva()
    {
        // traemos la tabla intermedia mostrar y lo convertimos a array
        $mostrar = DB::table("mostrar")->select("mostrar.id_mesa")->get();
       $mostrar_arrays = [];
        foreach($mostrar as $m) {
            array_push($mostrar_arrays, $m->id_mesa);
       }
    
        // traendo todas las mesas disponibles, cuando su id de la mesa no está en
        // la tabla intermedia, está disponible
        $mesas_d = DB::table("mesa")
        ->select("numero", "id")
        ->whereNotIn('id', $mostrar_arrays)
        ->get();

        $estados = $this->estados;
        $clientes = Cliente::all();
        $restaurantes = Restaurante::all();
    
        return view("vistaCrearReserva", 
        compact("estados", "mesas_d", "clientes", "restaurantes"));
    }

    public function crearReserva(Request $request)
    {
        $mesa = DB::table('mesa')->where('id', $request->input("numero_mesa"))->first();
        // validado si el numero de personas supera la capacidad de la mesa
    
        if ((int) $request->input("personas") > (int) $mesa->capacidad)
        {
            return redirect()->back()->with("message", "la mesa no aguanta");
        }

        $reserva = new Reserva();
        $reserva->fecha = $request->input("fecha");
        $reserva->servicio = $request->input("servicio");
        $reserva->num_personas = (int) $request->input("personas");
        $reserva->estado = $request->input("estado");
        $reserva->id_cliente = (int) $request->input("cliente");
        $reserva->id_restaurante = (int) $request->input("restaurante");
        $reserva->save();

        $mostrar = new Mostrar();
        $mostrar->id_mesa = (int) $request->input("numero_mesa");
        $mostrar->id_reserva = $reserva->id;
        $mostrar->save();
        return redirect()->back()->with("message", "reservado correctamente");
    }
}
