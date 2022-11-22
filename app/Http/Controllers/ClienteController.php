<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $request->active === null ? $active = 0 : $active = 1;
        Cliente::create([
            'nombre'=>$request->name,
            'tipo'=>$request->type,
            'ubicacion'=>$request->ubication,
            'telefono'=>$request->telephone,
            'mail'=>$request->mail,
            'producto'=>$request->product,
            'cif'=>$request->cif,
            'observaciones'=>$request->observations,
            'latitud'=>$request->latitude,
            'longitud'=>$request->longitude,
            'activo'=>$active
        ]);

        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->active === null ? $active = 0 : $active = 1;

        Cliente::where('id', $id)->update(
            ['nombre' => $request->name,
            'tipo' => $request->type,
            'ubicacion' => $request->ubication,
            'telefono' => $request->telephone,
            'mail' => $request->mail,
            'producto' => $request->product,
            'cif' => $request->cif,
            'observaciones' => $request->observations,
            'latitud' => $request->latitude,
            'longitud' => $request->longitude,
            'activo' => $active,
            ]);

            return redirect('/filter');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cliente::where('id', $id)->delete();
        return redirect('/home');
    }

}
