@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <form action="{{route('reserva.crear')}}" method="post">
            @csrf
                <label for="">fecha reserva</label>
                <input type="date" name="fecha" id=""></br>

                <label for="">tipo servicio</label>
                <select name="servicio" id="">
                    <option value="almuerzo">almuerzo</option>
                    <option value="cena">cena</option>
                </select> </br>

                <label for="">cantodad de personas</label>
                <input type="text" name="personas" id=""></br>

                <label for="">estado</label>
                <select name="estado" id="">
                    @foreach($estados as $e)
                    <option value="{{$e}}">{{$e}}</option>
                    @endforeach
                </select> </br>

                <label for="">Numero de Mesa</label>

                <select name="numero_mesa" id="">
                    @foreach($mesas_d as $m)
                    <option value="{{$m->id}}">{{$m->numero}}</option>
                    @endforeach
                </select> </br>
                
                <label for="">Cliente</label>
                <select name="cliente" id="">
                    @foreach($clientes as $c)
                    <option value="{{$c->id}}">{{$c->nombre}}</option>
                    @endforeach
                </select> </br>

                <label for="">Restaurante</label>
                <select name="restaurante" id="">
                    @foreach($restaurantes as $r)
                    <option value="{{$r->id}}">{{$r->nombre}} - {{$r->ubicacion}}</option>
                    @endforeach
                </select> </br>

                <input type="submit" name="submit" value="reservar">
           </form>

           <div class="mb-3">
            @if (Session::get('message'))
            {{ Session::get('message') }}
            @endif
        </div>
        </div>
    </div>
</div>
@endsection
