<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contenu;
use App\Models\Commentaire;

class ContenuController extends Controller
{
    /**
     * Affiche un contenu spécifique
     */
    public function show($id)
    {
        $contenu = Contenu::with([
            'getAuteur', 
            'getRegion', 
            'getLangue', 
            'getType',
            'medias',
            'commentaires.user'
        ])->valides()->findOrFail($id);
        
        // Contenus relatifs (même région ou même type)
        $contenusRelatifs = Contenu::with(['getAuteur', 'medias'])
            ->valides()
            ->where('id', '!=', $contenu->id)
            ->where(function($query) use ($contenu) {
                $query->where('region', $contenu->region)
                      ->orWhere('type', $contenu->type);
            })
            ->limit(4)
            ->get();
        
        return view('contenu.show', compact('contenu', 'contenusRelatifs'));
    }
    
    /**
     * Ajoute un commentaire
     */
    public function commenter(Request $request, $id)
    {
        $request->validate([
            'texte' => 'required|string|min:3|max:1000',
            'note' => 'nullable|integer|min:1|max:5',
        ]);
        
        $contenu = Contenu::valides()->findOrFail($id);
        
        Commentaire::create([
            'texte' => $request->texte,
            'note' => $request->note ?? 5,
            'datecomment' => now(),
            'statut' => 'actif', // Peut être modéré plus tard
            'contenu' => $contenu->id,
            'utilisateur' => Auth::id(),
        ]);
        
        return back()->with('success', 'Commentaire ajouté avec succès !');
    }
}