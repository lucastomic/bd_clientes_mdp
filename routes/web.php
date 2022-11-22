<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\HomeController;
use App\Models\Cliente;

Route::view('/', 'join');


Route::post('/join',[ UserController::class, 'join']);
Route::post('/createUser',[ UserController::class, 'createUser']);
Route::get('/close_session',[ UserController::class, 'closeSession']);


Route::get('/home', function(){
    return redirect('/filter');
});
Route::post('/home',  [HomeController::class, 'home']);
// if(session('logged') === true){
//     return view('home', ["clientes"=>$clientes]);
// }else{
//     return redirect('/');
// }

Route::view('/nuevo_cliente', 'nuevoCliente');
Route::view('/filter', 'filter');
Route::view('/crear_usuario', 'createNewUser');

Route::resource('cliente', ClienteController::class);
Route::resource('bitacoraController', BitacoraController::class);

Route::get('/client/{id}', function ($id) {
    $registro = Cliente::find($id);
    return view('client', ["cliente"=>$registro]);
});

Route::get('/updateData/{id}', function ($id) {
    $registro = Cliente::find($id);
    return view('updateData', ["id"=>$id, "cliente"=>$registro]);
});

Route::get('/deleteData/{id}', function ($id) {
    $registro = Cliente::find($id);
    return view('deleteData', ["id"=>$id, "cliente"=>$registro]);
});

Route::get('bitacora/{id}', function($id){
    $registro = Cliente::find($id);
    $comentarios = $registro->bitacoras;
    return view('bitacora', ["cliente"=>$registro, "comentarios"=>$comentarios]);
});

Route::get('nuevo_comentario/{id}', function($id){
    return view('newComment', ["id"=>$id]);
});