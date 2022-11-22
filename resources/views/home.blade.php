@extends('layout')

@section('head')
<style>
        #map {
            height: 50%;
        }
        /* Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .activo{
            text-align:center;
        }

        .activeCheck{
            width: 100px;
            height: 100px;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
            background: #5cb85c;
        }
    </style>
@endsection

@section('content')

<button class="customedBtn"><a href="{{url('/close_session')}}">Cerrar sesión</a></button>
<button class="customedBtn"><a href="{{url('/filter')}}">Volver a filtrar</a></button>
<div class="activeSwitch">
    <p>Solo clientes activos</p>

            <label class="switch">
                <input type="checkbox" class="switchBtn">
                <span class="slider round"></span>
            </label>

</div>
<div class="table tableHome">
    <table>
        <tr class="tHead">
            <th class="thHead" data-name="nombre"><button class="thBtn">Nombre</button></th>
            <th class="thHead" data-name="tipo"><button class="thBtn">Tipo</button></th>
            <th class="thHead" data-name="producto"><button class="thBtn">Producto</button></th>
            <th class="thHead" data-name="producto"><button class="thBtn">Última bitacora</button></th>
            <th class="thHead" data-name="ubicacion"><button class="thBtn">Ubicacion</button></th>
            <th>Activo</th>
        </tr>
        @foreach($clientes as $cliente)
            <tr class="trBody">
                <td class="nombre"><a href='{{url("/client/$cliente->id")}}'>{{$cliente->nombre}}</a></td>
                <td class="tipo">{{$cliente->tipo}}</td>
                <td class="producto">{{$cliente->producto}}</td>
                <td class="producto">{{$cliente->ultima_bitacora}}</td>
                <td class="ubicacion"><a href="https://maps.google.com/?ll={{$cliente->latitud}},{{$cliente->longitud}}&z=18" target="_blank">{{$cliente->ubicacion}}</a></td>
                <td class="activo">
                    @if($cliente->activo)
                        <img width='15vh' class="active" src="{{asset('images/green_circle.png')}}" alt=''>
                    @else
                        <img width='15vh' class="non-active" src="{{asset('images/red_circle.png')}}" alt=''>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</div>

<div class="newClientButton centerFlex">
    <button class="customedBtn"><a href="{{url('nuevo_cliente')}}">Nuevo cliente</a></button>
</div>


<div id="map"></div>

<script>
    // name cutter
    function cutName(name){
        let letters = name.split("" , 3)
        return String(letters[0]+letters[1]+letters[2])
    }

    // Google maps api
    function getMarkers(){
        let $td = document.querySelectorAll(".trBody .nombre"),
        clientesActivos = []

        $td.forEach((td)=>{
            if(td.parentNode.style.display != "none") clientesActivos.push(td.innerText)
        })

        let clientesPHP = [
            @foreach($clientes as $cliente)
                    @if($cliente->longitud != "" or $cliente->latitud != "")
                        {
                        name:"{{$cliente->nombre}}",
                        latitude:{{$cliente->latitud}},
                        longitude:{{$cliente->longitud}},
                        },
                    @else
                        {
                        name:"{{$cliente->nombre}}",
                        latitude:undefined,
                        longitude:undefined,
                        },
                    @endif
            @endforeach
        ];
        let marcadores = clientesPHP.filter((el)=>clientesActivos.indexOf(el.name) != -1)

        return marcadores;

    }


    function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
        center: {
        lat: 40.4166400,
        lng: -3.7032700
        },
        zoom: 5,
    });
    getMarkers().forEach(el=>{
        if(el.latitude != undefined && el.longitude != undefined){
            const marker = new google.maps.Marker({
                position: {lat:el.latitude, lng:el.longitude},
                map,
                label: cutName(el.name),
                title: el.name,
            });

            const infowindow = new google.maps.InfoWindow({
                content: el.name,
            });

            marker.addListener("click", () => {
                infowindow.open({
                anchor: marker,
                map,
                shouldFocus: false,
                });
            });
        }
    })
    }

    // Searcher

    function capitalizarPrimeraLetra(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    function closeSearcher(tHead){
        tHead.innerHTML = "<button class='thBtn'>"+capitalizarPrimeraLetra(tHead.dataset.name)+"</button>"
    }

    function rowsDisplay(){
        let $searchers = document.querySelectorAll(".searcher"),
        invisibleRows = [],
        $tr = document.querySelectorAll(".trBody")
        
        $tr.forEach((tr)=>{
            tr.style.display = "table-row";
        });

        $searchers.forEach($searcher=>{
            let $td = document.querySelectorAll("."+$searcher.dataset.name)
            $td.forEach(td=>{
                if(td.innerText.toLowerCase().indexOf($searcher.value.toLowerCase()) === -1){
                    invisibleRows.push(td.parentNode)
                }
            })
        });
        invisibleRows.forEach((row)=>{
            row.style.display = "none";
        });
    }
    
    function deleteUnactive(){
        let $td = document.querySelectorAll(".activo"),
        noneActiveTr = []

        $td.forEach((td)=>{
            if(td.childNodes[1].classList.contains("non-active")){
                noneActiveTr.push(td.parentNode)
            }
        });

        noneActiveTr.forEach((tr)=>{
            tr.style.display="none"
        })

    }

    document.addEventListener("click", e=>{
        // Si se toca el botón de cerrar el searcher
        if(e.target.classList.contains("closeBtn")){
            closeSearcher(e.target.parentNode);
            rowsDisplay();
            if(document.querySelector(".switchBtn").checked) deleteUnactive()
            initMap()
        }

        //  Genera el searcher y su boton de cierre
        if(e.target.classList.contains("thBtn")){
            let $searcher = document.createElement("input"),
            $closeBtn = document.createElement("button"),
            $thead = e.target.parentNode


            $closeBtn.innerText = "X";
            $closeBtn.classList.add("closeBtn");

            $searcher.type = "search";
            $searcher.setAttribute("data-name", $thead.dataset.name);
            $searcher.classList.add("searcher");

            $thead.innerHTML = "";
            $thead.insertAdjacentElement("beforeend",$searcher);
            $thead.insertAdjacentElement("beforeend", $closeBtn)
        }

        //para cuando se cambia el switch 
        if(e.target.classList.contains("switchBtn")){
            if(e.target.checked){
                deleteUnactive()  
                initMap()
            }else{
                rowsDisplay();
                initMap()
            }
        }
    })

    document.addEventListener("keyup", e=>{
        if(e.target.classList.contains("searcher")){
            rowsDisplay();
            if(document.querySelector(".switchBtn").checked) deleteUnactive()
            initMap()
        }
    })



</script>
<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCz8IS8ryD6Z5kn8Rvq6DwObryxnZcBDpo&callback=initMap&libraries=&v=weekly&channel=2"
async
></script>
@endsection
