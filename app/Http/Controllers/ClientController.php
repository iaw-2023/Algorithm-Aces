<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return ClientResource::collection($clients);
    }

    /**
     * Show the form for creating a new resource.
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
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email'
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
