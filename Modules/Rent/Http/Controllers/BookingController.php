<?php

namespace Modules\Rent\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Rent\Entities\Booking;
use Modules\Rent\Entities\Room;
use Modules\Rent\Transformers\BookingResource;

class BookingController extends Controller
{
    /**
     * __construct
     */
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }
    /**
     * index
     * @return Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $authUser = User::find(auth()->id());
        if ($authUser->isVendor())
            return BookingResource::collection(Booking::query()->orderByDesc('id')->simplePaginate(15));
        return BookingResource::collection(Booking::query()->where('user_id', $authUser->id)->orderByDesc('id')->simplePaginate(15));
    }
    /**
     * store
     * @param Request request
     * @return Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rooms' => ['required', 'array'],
            'rooms.*' => ['required', 'integer'],
            'date_since' => ['required', 'date'],
            'date_to' => ['required', 'date'],
            'guests' => ['required', 'array'],
            'guests.*.first_name' => ['required', 'string'],
            'guests.*.last_name' => ['required', 'string'],
            'guests.*.contact' => ['required', 'string'],
            'guests.*.arrival_details' => ['nullable', 'array'],
            'guests.*.address' => ['nullable', 'array'],
        ]);
        if ($validator->fails()) {
            return $this->sendError('Verifique los datos enviados');
        }
        $validator = $validator->validate();
        // Check rooms availability
        foreach ($validator['rooms'] as $roomID) {
            $room = Room::find($roomID);
            if (!$room || $room->isAvailable($validator['date_since'], $validator['date_to']))
                return $this->sendError();
        }
        $model = new Booking($validator);
        return $model->save()
            ? new BookingResource($model)
            : $this->sendError();
    }

    /**
     * show
     * @param int $id
     * @return Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $authUser = User::find(auth()->id());
        $model = Booking::find($id);
        if ($authUser->isVendor() || $model->user_id === auth()->id())
            return new BookingResource($model);
        return $this->sendError();
    }

    /**
     * Update
     * @param Request request
     * @return Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => ['required', 'in:CANCELED,ACCEPTED,COMPLETED']
        ]);
        if ($validator->fails()) {
            return $this->sendResponse();
        }
        $validator = $validator->validate();
        $model = Booking::find($id);
        $authUser = User::find(auth()->id());
        if (!$model) return $this->sendError();
        return (
            (auth()->id() === $model->user_id && $validator['status'] === 'CANCELED')
            || $authUser->isVendor()
        ) &&  $model->update($validator)
            ? new BookingResource($model)
            : $this->sendError();
    }

    /**
     * remove
     * @param int $id
     * @return Illuminate\Http\JsonResponse
     */
    public function remove(int $id)
    {
        $model = Booking::find($id);
        $authUser = User::find(auth()->id());
        if ($authUser->isVendor())
            return $this->sendResponse($model->delete());
        return $this->sendError();
    }
}
