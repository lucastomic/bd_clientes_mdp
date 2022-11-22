@extends('layout')

@section('content')
    <form action="{{url('/home')}}" method="post" class="centerFlex">
        @csrf
        <label for="name">Nombre</label>
        <input type="text" name="name">

        <label for="type">Tipo</label>
        <input type="text" name="type">

        <label for="product">Producto</label>
        <input type="text" name="product">

        <label for="ubication">Ubicación</label>
        <input type="text" name="ubication">

        <label for="active">Actividad</label>
        <select name="active">
            <option value="todos">Todos</option>
            <option value="on">Activos</option>
            <option value="off">Inactivos</option>
        </select>

        <input type="submit" class="submitBtn" value="Buscar">
    </form>
@endsection