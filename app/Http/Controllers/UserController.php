<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function login(Request $req) {

        $user = User::where(['email'=>$req->email])->first();
        if(!$user || !Hash::check($req->password, $user->password)) {

            return "Invalid Credential given!";
        }
        else {

            /* To store data in the session, you will typically use the request
            instance's put method or the global session helper */

            $req->session()->put('user', $user);
            // session(['user' => $user]);

            return redirect('/');
        }
    }
}
