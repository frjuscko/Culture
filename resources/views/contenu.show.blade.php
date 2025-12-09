<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $contenu->titre }} - Culture Bénin</title>
    <style>
        .contenu-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .contenu-header {
            margin-bottom: 30px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 20px;
        }
        
        .contenu-titre {
            font-size: 2em;
            color: #333;
            margin-bottom: 15px;
        }
        
        .contenu-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            color: #666;
            font-size: 0.9em;
        }
        
        .contenu-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .contenu-body {
            line-height: 1.8;
            font-size: 1.1em;
            color: #444;
            margin-bottom: 40px;
        }
        
        .medias-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin: 30px 0;
        }
        
        .media-item {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        
        .media-item img, .media-item video {
            width: 100%;
            height: 150px;
            object-fit: cover;
            display: block;
        }
        
        /* SECTION COMMENTAIRES */
        .commentaires-section {
            margin: 50px 0;
            padding: 30px;
            background: #f9f9f9;
            border-radius: 10px;
        }
        
        .commentaire-form {
            margin-bottom: 40px;
        }
        
        .commentaire-form textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            min-height: 120px;
            resize: vertical;
            margin-bottom: 15px;
        }
        
        .btn-commenter {
            background: #39C252;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }
        
        .commentaire-item {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        .commentaire-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .commentaire-auteur {
            font-weight: 600;
            color: #333;
        }
        
        .commentaire-date {
            color: #888;
            font-size: 0.9em;
        }
        
        .commentaire-texte {
            color: #555;
            line-height: 1.6;
        }
        
        /* CONTENUS RELATIFS */
        .relatifs-section {
            margin-top: 50px;
        }
        
        .relatifs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .relatif-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        
        .relatif-card:hover {
            transform: translateY(-5px);
        }
        
        .relatif-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        
        .relatif-body {
            padding: 15px;
        }
        
        .relatif-titre {
            font-size: 1em;
            margin: 0 0 10px 0;
            color: #333;
        }
        
        .btn-relatif {
            display: inline-block;
            color: #39C252;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="contenu-container">
        {{-- HEADER --}}
        <div class="contenu-header">
            <h1 class="contenu-titre">{{ $contenu->titre }}</h1>
            
            <div class="contenu-meta">
                <span>📍 {{ $contenu->region->nom }}</span>
                <span>🌐 {{ $contenu->langue->nom }}</span>
                <span>📝 {{ $contenu->typeContenu->libelle }}</span>
                <span>👤 {{ $contenu->auteur->prenom }} {{ $contenu->auteur->nom }}</span>
                <span>📅 {{ $contenu->datepub->format('d/m/Y à H:i') }}</span>
                <span>💬 {{ $contenu->commentaires->count() }} commentaires</span>
            </div>
        </div>
        
        {{-- MÉDIAS --}}
        @if($contenu->medias->count() > 0)
            <div class="medias-gallery">
                @foreach($contenu->medias as $media)
                    <div class="media-item">
                        @if($media->estImage())
                            <img src="{{ $media->url }}" alt="{{ $media->description }}" 
                                 title="{{ $media->description }}">
                        @elseif($media->estVideo())
                            <video controls>
                                <source src="{{ $media->url }}" type="{{ $media->type }}">
                                Votre navigateur ne supporte pas la vidéo.
                            </video>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
        
        {{-- CONTENU COMPLET --}}
        <div class="contenu-body">
            {!! nl2br(e($contenu->texte)) !!}
        </div>
        
        {{-- SECTION COMMENTAIRES --}}
        <div class="commentaires-section">
            <h2>💬 Commentaires ({{ $contenu->commentaires->count() }})</h2>
            
            {{-- FORMULAIRE DE COMMENTAIRE --}}
            @auth
                <form action="{{ route('contenu.commenter', $contenu->id) }}" method="POST" class="commentaire-form">
                    @csrf
                    <textarea name="texte" placeholder="Partagez votre avis sur ce contenu..." required></textarea>
                    <button type="submit" class="btn-commenter">Publier le commentaire</button>
                </form>
            @else
                <p style="color: #666; margin-bottom: 30px;">
                    <a href="{{ route('login') }}">Connectez-vous</a> pour laisser un commentaire.
                </p>
            @endauth
            
            {{-- LISTE DES COMMENTAIRES --}}
            <div class="commentaires-liste">
                @foreach($contenu->commentaires as $commentaire)
                    <div class="commentaire-item">
                        <div class="commentaire-header">
                            <span class="commentaire-auteur">
                                {{ $commentaire->utilisateur->prenom }} {{ $commentaire->utilisateur->nom }}
                            </span>
                            <span class="commentaire-date">
                                {{ $commentaire->datecomment->format('d/m/Y H:i') }}
                            </span>
                        </div>
                        <div class="commentaire-texte">
                            {{ $commentaire->texte }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        {{-- CONTENUS RELATIFS --}}
        @if($contenusRelatifs->count() > 0)
            <div class="relatifs-section">
                <h2>📚 Contenus similaires</h2>
                <div class="relatifs-grid">
                    @foreach($contenusRelatifs as $relatif)
                        <div class="relatif-card">
                            @if($relatif->medias->count() > 0)
                                <img src="{{ $relatif->medias->first()->url }}" 
                                     alt="{{ $relatif->titre }}" 
                                     class="relatif-image">
                            @else
                                <div style="height:150px;background:#f0f0f0;display:flex;align-items:center;justify-content:center;">
                                    🖼️
                                </div>
                            @endif
                            <div class="relatif-body">
                                <h3 class="relatif-titre">{{ Str::limit($relatif->titre, 50) }}</h3>
                                <a href="{{ route('contenu.show', $relatif->id) }}" class="btn-relatif">
                                    Lire la suite →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</body>
</html>