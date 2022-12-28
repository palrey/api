<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use TCG\Voyager\Models\Role;

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
        $current_app = env('APP_ENV') === 'testing' ? Application::first() : $request->current_app;

        return $this->sendAuthResponse(auth()->user(), $current_app);
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
        $model->role_id = Role::where('name', 'user')->first()->id;
        $current_app = env('APP_ENV') === 'testing' ? Application::first() : $request->current_app;
        return $model->save() ? $this->sendAuthResponse($model, $current_app) : $this->sendError();
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
        if (!$user || !$app) return $this->sendError();
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
