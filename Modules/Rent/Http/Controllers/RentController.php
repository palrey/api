<?php

namespace Modules\Rent\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\ImageHandler;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Modules\Rent\Entities\Rent;
use Modules\Rent\Transformers\RentResource;

class RentController extends Controller
{
    use ImageHandler;
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index()
    {
        return RentResource::collection(Rent::query()->where('open', true)->simplePaginate(15));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'small_description' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image'],
            'address' => ['nullable', 'array'],
            'address.country' => ['nullable', 'string'],
            'address.state' => ['nullable', 'string'],
            'address.city' => ['nullable', 'string'],
            'address.address' => ['nullable', 'string'],
            'address.postal_code' => ['nullable', 'string'],
            'address.position' => ['nullable', 'array'],
            'address.position.lat' => ['required', 'numeric'],
            'address.position.lng' => ['required', 'numeric'],
        ]);
        if ($validator->fails()) {
            return $this->sendError('Verifique los datos enviados');
        }
        $validator = $validator->validate();
        // Check permission
        $user = User::find(auth()->id());
        if (!$user->isVendor()) return $this->sendError('Permisos insufucientes');
        $validator['user_id'] = $user->id;
        if (isset($validator['image'])) {
            $validator['image'] = $this->imageUpload('rents', $request, 'image', 720);
        }
        $model = new Rent($validator);
        return $model->save()
            ? (new RentResource($model))->response()->status(Response::HTTP_CREATED)
            : $this->sendError();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $model = Rent::find($id);
        return $model ? new RentResource($model) : $this->sendError();
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['nullable', 'string'],
            'small_description' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image'],
            'address' => ['nullable', 'array'],
            'address.country' => ['nullable', 'string'],
            'address.state' => ['nullable', 'string'],
            'address.city' => ['nullable', 'string'],
            'address.address' => ['nullable', 'string'],
            'address.postal_code' => ['nullable', 'string'],
            'address.position' => ['nullable', 'array'],
            'address.position.lat' => ['required', 'numeric'],
            'address.position.lng' => ['required', 'numeric'],
        ]);
        if ($validator->fails()) {
            return $this->sendError('Verifique los datos enviados');
        }
        $validator = $validator->validate();
        $model = Rent::query()->where([
            ['id', $id],
            ['user_id', auth()->id()],
        ])->first();
        if (!$model) return $this->sendError();

        if (isset($validator['image'])) {
            $this->imageDelete($model->image);
            $validator['image'] = $this->imageUpload('rents', $request, 'image', 720);
        }
        return $model->update($validator)
            ? new RentResource($model)
            : $this->sendError();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $model = Rent::find($id);
        return $model && $model->delete() ? $this->sendResponse() : $this->sendError();
    }
    /**
     * showWithRents
     */
    public function showWithRents(int $id)
    {
        $model = Rent::query()->with('rents')->where('id', $id)->first();
        return $model ? new RentResource($model) : $this->sendError();
    }
}
