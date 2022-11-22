@extends('layout')

@section('content')
<button type="button" class="customedBtn" onclick="history.back();">Atrás</button>
    <h1>{{$cliente->nombre}}</h1>

    <table>
        <tr>
            <th class="thHead" data-name="nombre"><button class="thBtn">Nombre</button></th>
            <td class="nombre">{{$cliente->nombre}}</td>
        </tr>
        <tr>
            <th class="thHead" data-name="tipo"><button class="thBtn">Tipo</button></th>
            <td class="tipo">{{$cliente->tipo}}</td>
        </tr>
        <tr>
            <th class="thHead" data-name="producto"><button class="thBtn">Producto</button></th>
            <td class="producto">{{$cliente->producto}}</td>
        </tr>
        <tr>
            <th class="thHead" data-name="ubicacion"><button class="thBtn">Ubicacion</button></th>
            <td class="ubicacion"><a href="https://maps.google.com/?ll={{$cliente->latitud}},{{$cliente->longitud}}&z=18" target="_blank">{{$cliente->ubicacion}}</a></td>
        </tr>
        <tr>
            <th class="thHead" data-name="telefono"><button class="thBtn">Teléofno</button></th>
            <td class="telefono"><a href="tel:{{$cliente->telefono}}">{{$cliente->telefono}}</a></td>
        </tr>
        <tr>
            <th class="thHead" data-name="mail"><button class="thBtn">Mail</button></th>
            <td class="mail">{{$cliente->mail}}</td>
        </tr>
        <tr>
            <th class="thHead" data-name="cif"><button class="thBtn">CIF</button></th>
            <td class="cif">{{$cliente->cif}}</td>
        </tr>
        <tr>
            <th class="thHead" data-name="observaciones"><button class="thBtn">Observaciones</button></th>
            <td class="observaciones">{{$cliente->observaciones}}</td>
        </tr>
        <tr>
            <th>Activo</th>
            <td class="activo">
                @if($cliente->activo)
                    <img width='15vh' class="active" src="{{asset('images/green_circle.png')}}" alt=''>
                @else
                    <img width='15vh' class="non-active" src="{{asset('images/red_circle.png')}}" alt=''>
                @endif
            </td>
        </tr>
        <tr>
            <th>Bitácora</th>
            <td><button><a href='{{url("/bitacora/$cliente->id")}}'>Bitácora</a></button></td>
        </tr>
        <tr>
            <td><button><a href='{{url("/updateData/$cliente->id")}}'>Editar datos</a></button></td>
            <td><button><a href='{{url("/deleteData/$cliente->id")}}'>Borrar cliente</a></button></td>
        </tr>
    </table>
@endsection