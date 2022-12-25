<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserProfileResource;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    /**
     * store
     * @param Request request
     * @return Illuminate\Http\JsonResponse
     */
    public function setProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'tel' => ['nullable', 'string'],
            'address' => ['nullable', 'array'],
            'address.country' => ['nullable', 'string'],
            'address.state' => ['nullable', 'string'],
            'address.city' => ['nullable', 'string'],
            'address.address' => ['nullable', 'string'],
            'address.postal_code' => ['nullable', 'string'],
        ]);
        if ($validator->fails()) {
            return $this->sendError('Verifique los datos enviados');
        }
        $validator = $validator->validate();
        $authUser = User::find(auth()->id());
        $profile = $authUser->profile;
        if (!$profile) {
            $validator['user_id'] = auth()->id();
            $profile = new UserProfile($validator);
            return $profile->save()
                ? new UserProfileResource($profile)
                : $this->sendError();
        }
        return $profile->update($validator)
            ? new UserProfileResource($profile)
            : $this->sendError();
    }
    /**
     * getProfile
     */
    public function getProfile()
    {
        $authUser = User::find(auth()->id());
        $profile = $authUser->profile;
        return $profile
            ? new UserProfileResource($profile)
            : $this->sendError();
    }
}
