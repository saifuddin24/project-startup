<?php

namespace App\Http\Controllers\Api\Admin\Auth;

use App\Http\Controllers\Api\Admin\AdminApiController;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends AdminApiController
{

    public function registration( ){

    }

    public function login( Request $request){

        $fields = $request->validate([
            'email'     => 'required|string',
            'password'  => 'required|string|min:3',
        ]);



        // Check phone
        $user = User::where( 'email', $fields['email'])->first();



        // Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Email or password doesn\'t match!',
            ], 401);
        }

        return response($user->setAndGetLoginResponse(  ), 201);
    }

    public function logout( ){

    }



}
