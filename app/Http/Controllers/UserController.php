<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    public function Join(Request $request){
        $user = DB::table('users')->where('name', $request->user)->first();

        if($user != null){
            if($user->password == $request->password){
                session(['logged' => true]);
                session(['user' => $user->name]);
                return redirect('/filter');
            }else{
                $request->session()->flash('flashData', 'Contraseña incorrecta');
                return redirect('/');
            }
        }else{
            $request->session()->flash('flashData', 'Usuario incorrecto');
            return redirect('/');
        }
    }

    public function createUser(Request $request){
        if(DB::table('users')->where('name', $request->username)->first() != null){
            $request->session()->flash('flashData', 'Nombre ya en uso, elija otro nombre');
            return redirect('/crear_usuario');
        } 
        User::create([
            "name"=> $request->username,
            "password"=>$request->password
        ]);
        session(['logged' => true]);
        session(['user' => $request->username]);
        return redirect('/home');
    }

    public function closeSession(Request $request){
        $request->session()->forget('user');
        $request->session()->forget('logged');
        $request->session()->flash('flashData', 'Sesión cerrada');
        return redirect('/');
    }
}
