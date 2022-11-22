@extends('layout')
@section('content')
<button class="customedBtn"><a href='{{url("/bitacora/$id")}}'> Volver Atrás</a></button>
    <h1>Nuevo comentario</h1>

    <form action="{{route('bitacoraController.store')}}" method="post" class="centerFlex">
        @csrf
        <label for="dateTime">Fecha y hora</label>
        <input id="datetime" type="datetime-local" name="dateTime">
        <label for="comment">Comentario</label>
        <textarea name="comment" cols="30" rows="10"></textarea>
        <input type="hidden" value="{{$id}}" name="cliente_id">

        <input type="submit" value="Enviar">
    </form>

    <script>
        let $datetime = document.getElementById("datetime"),
        f = new Date(),
        month = f.getMonth() +1,
        date = f.getDate(),
        hours = f.getHours(),
        minutes = f.getMinutes()

        if(month<10) month = "0" + month;
        if(date<10) date = "0" + date;
        if(hours<10) hours = "0" + hours;
        if(minutes<10) minutes = "0" + minutes;

        let currentDate = f.getFullYear() + "-" + month + "-" + date + "T" + hours + ":" + minutes

        $datetime.value = currentDate
    </script>
@endsection
