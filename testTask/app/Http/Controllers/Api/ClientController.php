<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\ClientModel;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ClientResource::collection(ClientModel::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $car = ClientModel::create($request->validated());
        return new ClientResource($car);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientModel  $clientModel
     * @return \Illuminate\Http\Response
     */
    public function show(ClientModel $client)
    {
        return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientModel  $clientModel
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, ClientModel $client)
    {
        $client->update($request->validated());
        return new ClientResource($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientModel  $clientModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientModel $client)
    {
        $client->delete();
        return response()->noContent();
    }
}
