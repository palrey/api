<?php

namespace Modules\Rent\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Modules\Rent\Entities\Rent;
use Modules\Rent\Entities\Room;
use Modules\Rent\Transformers\RoomResource;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index()
    {
        return RoomResource::collection(Room::query()->simplePaginate(15));
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
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image'],
            'capacity' => ['required', 'integer'],
            'features' => ['nullable', 'array'],
            'features.*.key' => ['required', 'string'],
            'features.*.value' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return $this->sendError('Verifique los datos enviados');
        }
        $validator = $validator->validate();
        if (isset($validator['image'])) {
            $validator['image'] = $this->imageUpload('rooms', $request, 'image', 720);
        }
        $model = new Room($validator);
        return $model->save()
            ? (new RoomResource($model))->response()->status(Response::HTTP_CREATED)
            : $this->sendError();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $model = Room::find($id);
        return $model ? new RoomResource($model) : $this->sendError();
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
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image'],
            'capacity' => ['nullable', 'integer'],
            'features' => ['nullable', 'array'],
            'features.*.key' => ['required', 'string'],
            'features.*.value' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return $this->sendError('Verifique los datos enviados');
        }
        $validator = $validator->validate();
        $model = Room::find($id);
        if (!$model) return $this->sendError();

        if (isset($validator['image'])) {
            $this->imageDelete($model->image);
            $validator['image'] = $this->imageUpload('Rooms', $request, 'image', 720);
        }
        return $model->update($validator)
            ? new RoomResource($model)
            : $this->sendError();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $model = Room::find($id);
        return $model && $model->delete() ? $this->sendResponse() : $this->sendError();
    }

    /**
     * listByRent
     * @param int $rentId
     * @return JsonResponse
     */
    public function listByRent(int $rentId)
    {
        $rent = Rent::find($rentId);
        if (!$rent) return $this->sendError();

        return RoomResource::collection($rent->rooms);
    }

    /**
     * List Available
     * @param Request request
     * @return Illuminate\Http\JsonResponse
     */
    public function listAvailable(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rent_id' => ['nullable', 'integer'],
            'date' => ['required', 'array'],
            'date.since' => ['required', 'string'],
            'date.to' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return $this->sendError();
        }
        $validator = $validator->validate();
        $rooms = [];
        if ($validator['rent_id'])
            $qry = Room::query()->where([['open', true], ['rent_id', $validator['rent_id']]])->get();
        else
            Room::query()->where('open', true)->get();
        foreach ($qry as $room) {
            if ($room->isAvailable($validator['date']['since'], $validator['date']['to']))
                array_push($rooms, $room);
        }
        $roomsCollection = collect($rooms);
        return RoomResource::collection($roomsCollection);
    }
}
