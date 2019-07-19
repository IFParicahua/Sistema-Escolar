<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    public function rec($id){
        session()->put('key-user', $id);
        return redirect('/login');
    }
    public function view(){
        return view('logs');
    }
    public function login(){
        $credentials = $this->validate(request(),[
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            return "Hola";
        }else{
            return back()->withErrors(['username' => trans('auth.failed')])->withInput(request(['username']));
        }
    }
}
