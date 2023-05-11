<?php

namespace App\Http\Controllers\APIControllers;

use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\APIControllers\BaseAPIController;

class APIClientController extends BaseAPIController
{

        /**
     * @OA\Get(
     *      path="/clients",
     *      operationId="index",
     *      tags={"Clients"},
     *      summary="Get list of clients",
     *      description="Returns list of clients",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       )
     *     )
     *
     * Returns list of clients
     */
    public function index()
    {
        $clients = Client::all();
        return ClientResource::collection($clients);
    }

    /**
     * Show the form for creating a new client in JSON format.
     */
    public function create()
    {
        $clientFields = [
            'email' => [
                'type' => 'email',
                'label' => 'Email',
                'required' => true
            ],
        ];

        return response()->json(['fields' => $clientFields]);
    }


    /**
     * Store a newly created resource in storage and return the new client.
     * The new client must have an email that is not present currently in the clients database
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:clients,email'
        ]);

        $client = Client::create($validatedData);
        return new ClientResource($client);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::findOrFail($id);
        return new ClientResource($client);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
