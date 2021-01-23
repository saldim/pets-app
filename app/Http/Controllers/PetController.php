<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetRequest;
use App\Http\Resources\PetResource;
use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Pet::paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePetRequest $request)
    {
        $validated = $request->validated();
        $existOwner = Owner::where('phone', $validated['phone'])->first();
        if ($existOwner) {
            $validated['owner_id'] = $existOwner->id;
            return Pet::create($validated);
        } else {
            $newOwner = Owner::create($validated);
            $validated['owner_id'] = $newOwner->id;
            return Pet::create($validated);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Pet $pet
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        return new PetResource($pet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pet $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pet $pet)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Pet $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        //
    }
}
