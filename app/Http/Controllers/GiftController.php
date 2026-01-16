<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Http\Requests\GiftRequest;
use Illuminate\Support\Facades\Mail;

class GiftController extends Controller
{
    /**
     * Affiche la liste des cadeaux
     */
    public function index()
    {
        $gifts = Gift::all();
        return view('welcome', compact('gifts'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('gifts.create');
    }

    /**
     * Enregistre un nouveau cadeau
     */
    public function store(GiftRequest $request)
    {
        $gift = Gift::create($request->validated());

        // Envoi de l'email de confirmation
        Mail::raw(
            "Le cadeau {$gift->name} a bien été ajouté ({$gift->price}€)",
            function ($message) {
                $message->to('lamairiselsabil@gmail.com')
                    ->subject('Nouveau cadeau ajouté');
            }
        );

        return redirect()->route('gifts.index')
            ->with('success', 'Cadeau créé avec succès !');
    }

    /**
     * Affiche un cadeau
     */
    public function show(Gift $gift)
    {
        return view('gifts.show', compact('gift'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Gift $gift)
    {
        return view('gifts.edit', compact('gift'));
    }

    /**
     * Met à jour un cadeau
     */
    public function update(GiftRequest $request, Gift $gift)
    {
        $gift->update($request->validated());

        return redirect()->route('gifts.index')
            ->with('success', 'Cadeau modifié avec succès !');
    }

    /**
     * Supprime un cadeau
     */
    public function destroy(Gift $gift)
    {
        $gift->delete();

        return redirect()->route('gifts.index')
            ->with('success', 'Cadeau supprimé avec succès !');
    }
}