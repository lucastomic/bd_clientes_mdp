@extends('layout')

@section('content')
    <button type="button" class="customedBtn" onclick="history.back();">Atrás</button>
    <h1>Editar datos</h1>
    <form action='{{route("cliente.update", $id)}}' method="post" id="form" class="centerFlex">
        @csrf    
        @method('PUT')
        <label for="name">Nombre</label>
        <input type="text" name="name" value="{{$cliente->nombre}}">
        <label for="type">Tipo</label>
        <select name="type">
            <option <?php if($cliente->tipo === "Mayorista") echo "selected='selected'"?> value="Mayorista">Mayorista</option>
            <option <?php if($cliente->tipo === "Pescaderia") echo "selected='selected'"?> value="Pescaderia">Pescadería</option>
            <option <?php if($cliente->tipo === "Distribuidor") echo "selected='selected'"?> value="Distribuidor">Distribuidor</option>
        </select>
        <label for="ubication">Ubicacion</label>
        <input type="text" name="ubication" value="{{$cliente->ubicacion}}" id="ubication">
        <label for="telephone">Teléfono</label>
        <input type="text" name="telephone" value="{{$cliente->telefono}}">
        <label for="mail">Mail</label>
        <input type="text" name="mail" value="{{$cliente->mail}}">
        <label for="product">Producto</label>
        <input type="text" name="product" value="{{$cliente->producto}}">
        <label for="active">Activo</label>
        <input type="checkBox" name="active" 
            @if($cliente->activo)
            checked
            @endif
>
        <label for="cif">CIF</label>
        <input type="text" name="cif" value="{{$cliente->cif}}">
        <label for="observations">Observaciones</label>
        <input type="text" name="observations" value="{{$cliente->observaciones}}">
        <input type="hidden" name="latitude" id="latitude" value="{{$cliente->latitud}}">
        <input type="hidden" name="longitude" id="longitude" value="{{$cliente->longitud}}">
        <input type="submit" id="submitBtn" value="Actualizar" class="customedBtn submitBtn">
    </form>

    <script>
        const getCoords = (dir) =>{
            const direccion = dir.replace(/ /g,"+"),
            $form = document.getElementById("form")
            fetch('https://maps.googleapis.com/maps/api/geocode/json?address='+direccion+'&key=AIzaSyCz8IS8ryD6Z5kn8Rvq6DwObryxnZcBDpo')
            .then(response => response.json())
            .then(data =>{
                let latitude = data.results[0].geometry.location.lat,
                longitude = data.results[0].geometry.location.lng

                document.getElementById("latitude").value = latitude
                document.getElementById("longitude").value = longitude 
            })
            .then(()=>$form.submit())
        }   

        document.getElementById("submitBtn").addEventListener("click", (e)=>{
            if(document.getElementById("ubication").value != ""){
                e.preventDefault();
                getCoords(document.getElementById("ubication").value)
            }
        })
    </script>
@endsection

