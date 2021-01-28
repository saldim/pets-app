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
        $validated['owner_id'] = $existOwner ? $existOwner->id : Owner::create($validated)->id;
        return Pet::create($validated);
    }

    /**
     * Поиск питомцев по номеру хозяина
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {
        return PetResource::collection(
            Owner::where('phone', $request->input('phone'))
            ->firstOrFail()
            ->pets()
            ->paginate(10)
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
