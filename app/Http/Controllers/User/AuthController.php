<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
            'password' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return $this->sendError('Verifique los datos enviados');
        }
        $validator = $validator->validate();
        if (!auth()->attempt($validator)) return $this->sendError('Credenciales incorrectas', 401);

        return $this->sendAuthResponse(auth()->user(), $request->current_app);
    }

    /**
     *
     * @param Request request
     * @return Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
        ]);
        if ($validator->fails()) {
            return $this->sendError('Verifique los datos enviados');
        }
        $validator = $validator->validate();
        // TODO Send confirmation email
        $validator['password'] = Hash::make($validator['password']);
        $model = new User($validator);
        return $model->save() ? $this->sendAuthResponse($model, $request->current_app) : $this->sendError();
    }
    /**
     * refreshToken
     */
    public function refreshToken()
    {
        // TODO Refresh Token
    }
    /**
     * sendAuthResponse
     * @param User $user
     * @param Application $app
     */
    private function sendAuthResponse(User $user, Application $app)
    {
        // TODO Update tokens before delete it
        $user->tokens()->where('name', $app->title)->delete();
        $token = $user->createToken($app->title);
        return [
            'user' => new UserResource($user),
            'token' => $token->plainTextToken,
            'role' => $user->role->name
        ];
    }
}
