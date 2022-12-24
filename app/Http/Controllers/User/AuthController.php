<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     *
     * @param Request request
     * @return Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'confirmed'],
        ]);
        if ($validator->fails()) {
            return $this->sendError('Verifique los datos enviados');
        }
        $validator = $validator->validate();

        if (!auth()->attempt($validator)) return $this->sendError('Credenciales incorrectas', 401);
    }
}
