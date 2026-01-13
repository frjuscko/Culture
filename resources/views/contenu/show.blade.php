<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ URL::asset('frontend/css/contenu.css') }}">
    <title>{{ $contenu->titre }} - Culture Bénin</title>
</head>

<body>
    <div class="cover">
        <h1 class="contenu-titre">Blog</h1>
        <p><a href="/">Accueil</a><span>></span><a href="">Blog</a><span>></span><span>{{ $contenu->titre }}</span></p>
    </div>
    <div class="contenu-container">
        <div class="part-left">
            {{-- HEADER --}}
            <div class="contenu-header">
                <h1 class="contenu-titre">{{ $contenu->titre }}</h1>

                <div class="contenu-meta">
                    <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2ZM16.0043 12.8777C15.6589 12.3533 15.4097 11.9746 14.4622 12.1248C12.6717 12.409 12.4732 12.7224 12.3877 13.2375L12.3636 13.3943L12.3393 13.5597C12.2416 14.2428 12.2453 14.5012 12.5589 14.8308C13.8241 16.1582 14.582 17.115 14.8116 17.6746C14.9237 17.9484 15.2119 18.7751 15.0136 19.5927C16.2372 19.1066 17.3156 18.3332 18.1653 17.3559C18.2755 16.9821 18.3551 16.5166 18.3551 15.9518V15.8472C18.3551 14.9247 18.3551 14.504 17.7031 14.1314C17.428 13.9751 17.2227 13.881 17.0582 13.8064C16.691 13.6394 16.4479 13.5297 16.1198 13.0499C16.0807 12.9928 16.0425 12.9358 16.0043 12.8777ZM12 3.83333C9.68259 3.83333 7.59062 4.79858 6.1042 6.34896C6.28116 6.47186 6.43537 6.64453 6.54129 6.88256C6.74529 7.34029 6.74529 7.8112 6.74529 8.22764C6.74488 8.55621 6.74442 8.8672 6.84992 9.09302C6.99443 9.40134 7.6164 9.53227 8.16548 9.64736C8.36166 9.68867 8.56395 9.73083 8.74797 9.78176C9.25405 9.92233 9.64554 10.3765 9.95938 10.7412C10.0896 10.8931 10.2819 11.1163 10.3783 11.1717C10.4286 11.1356 10.59 10.9608 10.6699 10.6735C10.7307 10.4547 10.7134 10.2597 10.6239 10.1543C10.0648 9.49445 10.0952 8.2232 10.268 7.75495C10.5402 7.01606 11.3905 7.07058 12.012 7.11097C12.2438 7.12589 12.4626 7.14023 12.6257 7.11976C13.2482 7.04166 13.4396 6.09538 13.575 5.91C13.8671 5.50981 14.7607 4.9071 15.3158 4.53454C14.3025 4.08382 13.1805 3.83333 12 3.83333Z">
                            </path>
                        </svg> {{ $contenu->getRegion->nom }}</span>
                    <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M18.5 10L22.9 21H20.745L19.544 18H15.454L14.255 21H12.101L16.5 10H18.5ZM10 2V4H16V6L14.0322 6.0006C13.2425 8.36616 11.9988 10.5057 10.4115 12.301C11.1344 12.9457 11.917 13.5176 12.7475 14.0079L11.9969 15.8855C10.9237 15.2781 9.91944 14.5524 8.99961 13.7249C7.21403 15.332 5.10914 16.5553 2.79891 17.2734L2.26257 15.3442C4.2385 14.7203 6.04543 13.6737 7.59042 12.3021C6.46277 11.0281 5.50873 9.57985 4.76742 8.00028L7.00684 8.00037C7.57018 9.03885 8.23979 10.0033 8.99967 10.877C10.2283 9.46508 11.2205 7.81616 11.9095 6.00101L2 6V4H8V2H10ZM17.5 12.8852L16.253 16H18.745L17.5 12.8852Z">
                            </path>
                        </svg> {{ $contenu->getLangue->nom }}</span>
                    <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M21 3C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H21ZM9 8C6.792 8 5 9.792 5 12C5 14.208 6.792 16 9 16C10.1 16 11.1 15.55 11.828 14.828L10.4144 13.4144C10.0525 13.7762 9.5525 14 9 14C7.895 14 7 13.105 7 12C7 10.895 7.895 10 9 10C9.55 10 10.0483 10.22 10.4153 10.5866L11.829 9.173C11.1049 8.44841 10.1045 8 9 8ZM16 8C13.792 8 12 9.792 12 12C12 14.208 13.792 16 16 16C17.104 16 18.104 15.552 18.828 14.828L17.4144 13.4144C17.0525 13.7762 16.5525 14 16 14C14.895 14 14 13.105 14 12C14 10.895 14.895 10 16 10C16.553 10 17.0534 10.2241 17.4153 10.5866L18.829 9.173C18.1049 8.44841 17.1045 8 16 8Z">
                            </path>
                        </svg> {{ $contenu->getType->libelle }}</span>
                    <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M9 2C13.0675 2 16.426 5.03562 16.9337 8.96494L19.1842 12.5037C19.3324 12.7367 19.3025 13.0847 18.9593 13.2317L17 14.071V17C17 18.1046 16.1046 19 15 19H13.001L13 22H4L4.00025 18.3061C4.00033 17.1252 3.56351 16.0087 2.7555 15.0011 1.65707 13.6313 1 11.8924 1 10 1 5.58172 4.58172 2 9 2ZM21.1535 18.1024 19.4893 16.9929C20.4436 15.5642 21 13.8471 21 12.0001 21 10.153 20.4436 8.4359 19.4893 7.00722L21.1535 5.89771C22.32 7.64386 23 9.74254 23 12.0001 23 14.2576 22.32 16.3562 21.1535 18.1024Z">
                            </path>
                        </svg> {{ $contenu->getAuteur->prenom }} {{ $contenu->getAuteur->nom }}</span>
                    <span>📅 {{ $contenu->created_at->format('D M Y à H:i') }}</span>
                    <span>💬 {{ $contenu->commentaires->count() }} commentaires</span>
                </div>
            </div>

            {{-- MÉDIAS --}}
            @if($contenu->medias->count() > 0)
                <div class="medias-gallery">
                    @foreach($contenu->medias as $media)
                        <div class="media-item">
                            @if($media->estImage())
                                <img src="{{ $media->url }}" alt="{{ $media->description }}" title="{{ $media->description }}">
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
            <div class="categorie">
                <p>📅 {{ $contenu->created_at->format('d M Y') }} | {{ $contenu->getType->libelle }}</p>
            </div>

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
                                    <img src="{{ $commentaire->user->photo }}" alt="{{ $commentaire->user->prenom }}"
                                        style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;">
                                    {{ $commentaire->user->prenom }} {{ $commentaire->user->nom }}
                                </span>
                                <span class="commentaire-date">
                                    {{ $commentaire->created_at->format('D M Y H:i') }}
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
                                    <img src="{{ $relatif->medias->first()->url }}" alt="{{ $relatif->titre }}"
                                        class="relatif-image">
                                @else
                                    <div
                                        style="height:150px;background:#f0f0f0;display:flex;align-items:center;justify-content:center;">
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
        <div class="part-right">
            @if (Auth::check() && Auth::id() == $contenu->getAuteur->id)
                <a href="" class="edit-btn">Modifier ce contenu</a>
            @else
                <div class="auteur">
                    <h2>À propos de l'auteur</h2>
                    <div class="photo">
                        <img src="{{ $contenu->getAuteur->photo }}" alt="{{ $contenu->getAuteur->prenom }}"
                            style="width: 100px; height: 100px; border-radius: 50%;">
                    </div>
                    <div class="texte">
                        <p class="nom">{{ $contenu->getAuteur->prenom }} {{ $contenu->getAuteur->nom }}</p>
                        <p class="infos">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        <a href="{{ route('profil.show', $contenu->getAuteur->id) }}" class="nom-lien">
                            <p class="nom">Voir le profil</p>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</body>

</html>