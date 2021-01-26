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
     * Возвращает список питомцев для главной страницы
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PetResource::collection(Pet::paginate(10));
    }

    /**
     * Добавляет нового питомца
     *
     * @param \App\Http\Requests\StorePetRequest $request
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
     * Поиск питомцев по номеру хозяина
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {
        return PetResource::collection(
            Pet::where('owners.phone', $request->input('phone'))
            ->leftJoin('owners', 'pets.owner_id', '=', 'owners.id')->paginate(10)
           // ->get()
        );
    }

    /**
     * Возвращает конкретного питомца
     *
     * @param \App\Models\Pet $pet
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        return new PetResource($pet);
    }
}
