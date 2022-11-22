@extends('layout')

@section('content')
    <h1>¿Está seguro de borrar el registro de {{$cliente->nombre}}?</h1>
    <div class="deleteOptions">
        <form action="{{route('cliente.destroy', $id)}}" method="post">
            @csrf
            @method('delete')
            <button class="customedBtn deleteBtn deleteBtnYes"><input type="submit" value="Sí"></button>
        </form>
        <button class="customedBtn deleteBtn"><a href="{{url('/home')}}">No</a></button>
    </div>
@endsection