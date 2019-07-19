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
    public function inicio(){
        $roles = DB::table('roles')
            ->join('persona_roles', 'roles.id', '=', 'persona_roles.id_rol')
            ->where('persona_roles.id_persona', '=',Auth::user()->id)
            ->select('persona_roles.id_rol as idroles','roles.categoria_rol as roluser')
            ->get();
        return view('index',['roles' => $roles]);
    }
    public function login(){
        $credentials = $this->validate(request(),[
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = Request::get('username');

        if (Auth::attempt($credentials)) {
            return redirect('/inicio');
        }else{
            return back()->withErrors(['username' => trans('auth.failed')])->withInput(request(['username']));
        }
    }

}
