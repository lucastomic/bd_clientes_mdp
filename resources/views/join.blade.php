@extends('layout')

@section('content')
    @if(Session::has('flashData'))
        <span class="flashData">{{session('flashData')}}</span>
    @endif

    <form action="{{url('/join')}}" method="post" class="centerFlex">
    @csrf
        <label for="user">Usuario</label>
        <input name="user" type="text">
        <label for="password">Password</label>
        <input name="password" type="password">
        <input type="submit" value="Entrar" class="customedBtn submitBtn">
        <button class="customedBtn"><a href="{{url('crear_usuario')}}">Crear usuario</a></button>
    </form>
    <script>
        const $flashData = document.querySelector(".flashData");
        if($flashData != null){
            setTimeout(() => {
                $flashData.innerText = "";
            }, 3000);
        }
    </script>
@endsection
