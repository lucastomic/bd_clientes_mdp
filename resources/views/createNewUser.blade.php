@extends('layout')

@section('content')
    <button class="customedBtn"><a href="{{url('/')}}"> Volver Atrás</a></button>
    @if(Session::has('flashData'))
        <span class="flashData">{{session('flashData')}}</span>
    @endif
    <h1>Crear nuevo usuario</h1>

    <form action="{{url('/createUser')}}" method="post" class="centerFlex">
        @csrf
        <label for="username">Nombre</label>
        <input type="text" name="username">
        <label for="password">Contraseña</label>
        <input type="password" name="password">
        <input type="submit" value="Enviar">
    </form>
    <script>
        const $flashData = document.querySelector(".flashData");
        if($flashData != null){
            setTimeout(() => {
                $flashData.innerText = "";
            }, 5000);
        }
    </script>
@endsection