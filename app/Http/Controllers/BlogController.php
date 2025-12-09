<?php

namespace App\Http\Controllers;
use App\Models\Contenu;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;

class BlogController extends Controller
{
    public function index(Request $request){
        $search = $request->get('search');

        $contenus = Contenu::with(['getType', 'getRegion', 'getLangue', 'medias', 'getAuteur'])
        ->when($search, function($query, $search) {
            return $query->where('titre', 'like', "%{$search}%")
                        ->orWhere('getType.libelle', 'like', "%{$search}%");
        })
        ->where('statut', 'validé')
        ->orderBy('created_at', 'DESC')
        ->paginate(9);

        return view('blog', compact('contenus', 'search'));
    }
}
