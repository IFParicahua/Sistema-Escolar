<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class LoginController extends Controller
{
    
    public function login(){
        $credentials = $this->validate(request(),[
            'username' => 'required|string',
            'password' => 'required|string',
        ]);


        if (Auth::attempt($credentials)) {
            return redirect('/inicio');
        }else{
            return back()->withErrors(['username' => trans('auth.failed')])->withInput(request(['username']));
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function inicio(){
        $roles = DB::table('roles')
            ->join('persona_roles', 'roles.id', '=', 'persona_roles.id_rol')
            ->where('persona_roles.id_persona', '=',Auth::user()->id)
            ->select('persona_roles.id_rol as idroles','roles.categoria_rol as roluser')
            ->get();
        return view('index',['roles' => $roles]);
    }

    public function redirect($id){
        switch ($id) {
            case '1':
                return redirect('/Administrador');
                break;
            case '2':
                return redirect('/Contador');
                break;
            case '3':
                return redirect('/Regente');
                break;
            
            case '4':
                return redirect('/Profesor');
                break;
    
            case '5':
                return redirect('/Padre');
                break;
        }
    }

}
