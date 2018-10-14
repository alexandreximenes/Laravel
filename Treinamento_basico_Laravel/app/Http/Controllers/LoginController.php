<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Request;

class LoginController extends Controller
{
    public function form(){
        return view('login');
    }

    public function login(Request $request){
        $credentials = $request->only('login', 'senha');
        if(Auth::attempt($credentials)){
            return redirect('/');
        }else{
            return 'Usuario não existe';
        }

    }
}
