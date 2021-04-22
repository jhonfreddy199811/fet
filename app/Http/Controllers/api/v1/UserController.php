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
            'email' => ['required', 'max:100', 'unique:users'],
            'name' => ['required', 'max:100' ],
            'password' => ['required', 'max:100'],
        ], $message);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $user->save();
        return response()->json(['user'=>$user]);
    }
}
