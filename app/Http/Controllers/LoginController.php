<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    /**
     * @param Request|mixed $request
     * @return \Laravel\Airlock\string|string
     * @throws ValidationException
     */
    public function access(Request $request)
    {
        $v = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);
        if ($v->fails()) {
            return response()->json($v->errors(), 401);
        }
        /** @var User|mixed $user */
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['El email es incorrecto.'], 401);
        }
        return $user->createToken($request->device_name)->plainTextToken;
    }

}
