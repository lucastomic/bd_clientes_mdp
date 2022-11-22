@extends('layout')

@section('content')
    <button type="button" class="customedBtn" onclick="history.back();">Atrás</button>
    <h1>Bitácora de {{$cliente->nombre}}</h1>

    <table class="table">
        <tr>
            <th>Fecha</th>
            <th>Comentario</th>
            <th>Vendedor</th>
        </tr>
        @foreach($comentarios as $comentario)
            <tr>
                <td>{{$comentario->fecha}}</td>
                <td>{{$comentario->comentario}}</td>
                <td>{{$comentario->vendedor}}</td>
            </tr>
        @endforeach
    </table>
    <div class="centerFlex">
        <button class="customedBtn"><a href='{{url("/nuevo_comentario/$cliente->id")}}'>Nuevo comentario</a></button>
    </div>
@endsection