<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request){
        if($request->active === "todos"){
            $active = null;
            $inactive = null;
        }else if($request->active === "on"){
            $active = 1;
            $inactive = null;
        }else if($request->active === "off"){
            $inactive = 1;
            $active = null;
        }

        $clientes = Cliente::when($request->name, function($query, $name){
            return $query->where('nombre', 'LIKE', '%'.$name.'%');
        })
        ->when($request->type, function($query, $type){
            return $query->where('tipo', 'LIKE', '%'.$type.'%');
        })
        ->when($request->product, function($query, $product){
            return $query->where('producto', 'LIKE', '%'.$product.'%');
        })
        ->when($request->ubication, function($query, $ubication){
            return $query->where('ubicacion', 'LIKE', '%'.$ubication.'%');
        })
        ->when($active, function($query, $active){
            return $query->where("activo", "=" , 1);
        })
        ->when($inactive, function($query, $inactive){
            return $query->where("activo", "=" , 0);
        })
        ->get();

        return view('home', ["clientes"=>$clientes]);
    }
}
