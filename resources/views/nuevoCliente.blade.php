@extends('layout')

@section('content')
    <button class="customedBtn"><a href="{{url('/home')}}"> Volver Atrás</a></button>
    <h1>Inserte los datos</h1>
    <form action="{{route('cliente.store')}}" method="post" id="form" class="centerFlex">
        @csrf
        <label for="name">Nombre</label>
        <input type="text" name="name" required>

        <label for="type">Tipo</label>
        <select name="type">
            <option value="Mayorista">Mayorista</option>
            <option value="Pescaderia">Pescadería</option>
            <option value="Distribuidor">Distribuidor</option>
        </select>

        <label for="ubication">Ubicacion</label>
        <input type="text" id="ubication" name="ubication">

        <label for="telephone">Teléfono</label>
        <input type="tel" name="telephone">
        
        <label for="mail">Mail</label>
        <input type="mail" name="mail">

        <label for="active">Activo</label>
        <input type="checkbox" name="active">
        
        <label for="product">Productos</label>
        <input type="text" name="product">
        
        <label for="cif">CIF</label>
        <input type="number" name="cif">

        <label for="observations">Observaciones</label>
        <input type="text" name="observations">

        <input type="hidden" id="latitude" name="latitude">
        <input type="hidden" id="longitude" name="longitude">

        <input type="submit" id="submitBtn" value="Enviar" class="customedBtn submitBtn">
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
