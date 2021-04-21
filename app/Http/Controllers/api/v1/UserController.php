<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;


class UserController extends Controller
{
    //
    public function current()
    {
        $user = Auth::user();
        return[
            'user' => $user
        ];
    }

    public function index()
    {
      $users = User ::all();
      return[
          'users' => $users
      ];
    }
    public function store(Request $request)
    {
        $message =[
            'email.unique' => 'Este email ya existe',
        ];
        $this->validate(request(),[
            'email' => ['requiered', 'max:100', 'unique:users'],
        ], $message);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = \Hash::$request->password;
        $user->save();
        return response()->json(['user'=>$user]);
    }
}
