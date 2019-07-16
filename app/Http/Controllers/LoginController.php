<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function rec($id){
        session()->put('key-user', $id);
        return redirect('/login');
    }
    public function view(){
        return view('logins');
    }
}
