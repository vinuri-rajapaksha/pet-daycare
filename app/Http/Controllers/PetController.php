<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pets = auth()->user()->pets;

        return view('pets.index', ['pets' => $pets]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'breed' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        auth()->user()->pets()->create($validated);

        return redirect()->route($request->input('redirect_to', 'pets.index'));
    }

    public function edit(Pet $pet)
    {
        if ($pet->user_id !== auth()->id()) {
            abort(403);
        }

        return view('pets.edit', ['pet' => $pet]);
    }

    public function update(Request $request, Pet $pet)
    {
        if ($pet->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'pet_type' => 'required|in:dog,cat',
            'age' => 'nullable|integer|min:0|max:30',
            'breed' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $pet->update($validated);

        return redirect()->route('pets.index');
    }

    public function destroy(Pet $pet)
    {
        if ($pet->user_id !== auth()->id()) {
            abort(403);
        }

        $pet->delete();

        return redirect()->route('pets.index');
    }
}
