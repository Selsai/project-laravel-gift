<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function index()
    {
        $gifts = Gift::all();
        return view('welcome', compact('gifts'));
    }

    public function create()
    {
        return view('gifts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:50',
            'url' => 'nullable|url',
            'details' => 'nullable|string',
            'price' => 'required|numeric|min:0|decimal:2',
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'name.min' => 'Le nom doit contenir au moins 3 caractères.',
            'name.max' => 'Le nom ne peut pas dépasser 50 caractères.',
            'url.url' => 'L\'URL doit être valide (http:// ou https://).',
            'price.required' => 'Le prix est obligatoire.',
            'price.numeric' => 'Le prix doit être un nombre.',
            'price.min' => 'Le prix ne peut pas être négatif.',
            'price.decimal' => 'Le prix ne peut avoir que 2 chiffres après la virgule.',
        ]);

        Gift::create($validated);

        return redirect()->route('gifts.index')->with('success', 'Cadeau créé avec succès !');
    }

    public function show(Gift $gift)
    {
        return view('gifts.show', compact('gift'));
    }

    public function edit(Gift $gift)
    {
        return view('gifts.edit', compact('gift'));
    }

    public function update(Request $request, Gift $gift)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:50',
            'url' => 'nullable|url',
            'details' => 'nullable|string',
            'price' => 'required|numeric|min:0|decimal:2',
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'name.min' => 'Le nom doit contenir au moins 3 caractères.',
            'name.max' => 'Le nom ne peut pas dépasser 50 caractères.',
            'url.url' => 'L\'URL doit être valide (http:// ou https://).',
            'price.required' => 'Le prix est obligatoire.',
            'price.numeric' => 'Le prix doit être un nombre.',
            'price.min' => 'Le prix ne peut pas être négatif.',
            'price.decimal' => 'Le prix ne peut avoir que 2 chiffres après la virgule.',
        ]);

        $gift->update($validated);

        return redirect()->route('gifts.index')->with('success', 'Cadeau modifié avec succès !');
    }

    public function destroy(Gift $gift)
    {
        $gift->delete();
        return redirect()->route('gifts.index')->with('success', 'Cadeau supprimé avec succès !');
    }
}
