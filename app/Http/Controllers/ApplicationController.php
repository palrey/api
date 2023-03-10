<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ApplicationController extends Controller
{
    /**
     * __construct
     */
    public function __construct()
    {
        // $this->middleware('auth:sanctum')->except(['show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ApplicationResource::collection(Application::query()->where('active', true)->simplePaginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'contact' => ['required', 'string'],
            'version_name' => ['required', 'string'],
            'version_code' => ['required', 'integer'],
            'modules' => ['nullable', 'array'],
            'modules.*' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return $this->sendError('Verifique los datos enviados');
        }
        $validator = $validator->validate();
        $model = new Application($validator);
        return $model->save()
            ? (new ApplicationResource($model))->response()->status(Response::HTTP_CREATED)
            : $this->sendError();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Application::find($id);
        return $model ?  $this->sendAppResponse($model) : $this->sendError();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Application::find($id);
        return $model ?  $model->delete() : $this->sendError();
    }

    private function sendAppResponse(Application $application)
    {
        return [
            'application' => new ApplicationResource($application),
            'token' => $application->publicHash
        ];
    }
}
