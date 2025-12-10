@extends('frontend')
@section('content')
    <div class="cover">
        <h1 class="contenu-titre">Blog</h1>
        <p><a href="/">Accueil</a><span>></span><a href=""></a><span>Blog</span></p>
    </div>
    <div class="search-bar">
        <form action="{{ route('blog') }}" method="GET">
            <input type="text" name="search" value="{{ $search }}" placeholder="Rechercher.." class="search-input">
            <button type="submit" class="search-btn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    fill="currentColor">
                    <path
                        d="M12 14V22H4C4 17.5817 7.58172 14 12 14ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM21.4462 20.032L22.9497 21.5355L21.5355 22.9497L20.032 21.4462C19.4365 21.7981 18.7418 22 18 22C15.7909 22 14 20.2091 14 18C14 15.7909 15.7909 14 18 14C20.2091 14 22 15.7909 22 18C22 18.7418 21.7981 19.4365 21.4462 20.032ZM18 20C19.1046 20 20 19.1046 20 18C20 16.8954 19.1046 16 18 16C16.8954 16 16 16.8954 16 18C16 19.1046 16.8954 20 18 20Z">
                    </path>
                </svg></button>
        </form>
    </div>
    <div class="contenus">
        <div class="title-zone">
            <h3 class="section-title">
                <hr>À la une
            </h3>
            <h1 class="grand-title">Trésors culturels à découvrir</h1>
            <p class="section-text">Plongez au cœur de la richesse
                culturelle béninoise avec ces contenus sélectionnés pour
                vous. Des histoires qui traversent les générations, des
                saveurs qui racontent nos terroirs, des savoir-faire qui
                honorent nos ancêtres.</p>
        </div>
        @if ($contenus->count() > 0)
            <div class="contenu-cards">
                @foreach ($contenus as $contenu)
                    <div class="contenu-card">

                        <div class="image">
                            @if($contenu->medias->count() > 0)
                                @php $media = $contenu->medias->first() @endphp
                                @if($media->estImage())
                                    <img src="{{ $media->url }}" alt="{{ $contenu->titre }}" class="contenu-image">
                                @elseif($media->estVideo())
                                    <div class="video-placeholder">
                                        🎬 Vidéo disponible
                                    </div>
                                @endif
                            @else
                                <div class="no-image">🖼️</div>
                            @endif
                        </div>
                        <div class="texte">
                            <h3 class="categorie">{{ $contenu->getType->libelle }}</h3>
                            <h1 class="titre">{{ $contenu->titre }}</h1>
                            <p class="description">
                                {{ Str::limit(strip_tags($contenu->texte), 150) }}
                                @if(strlen(strip_tags($contenu->texte)) > 150)
                                    <a href="{{ route('contenu.show', $contenu->id) }}" class="read-more">...Lire la suite</a>
                                @endif
                            </p>
                        </div>
                        <div class="down">
                            <h3 class="date">{{ $contenu->created_at->format('d M Y') }}</h3>
                            <button><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12.001 4.52853C14.35 2.42 17.98 2.49 20.2426 4.75736C22.5053 7.02472 22.583 10.637 20.4786 12.993L11.9999 21.485L3.52138 12.993C1.41705 10.637 1.49571 7.01901 3.75736 4.75736C6.02157 2.49315 9.64519 2.41687 12.001 4.52853Z">
                                    </path>
                                </svg></button>
                            <p>0</p>
                            <button><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M10 3H14C18.4183 3 22 6.58172 22 11C22 15.4183 18.4183 19 14 19V22.5C9 20.5 2 17.5 2 11C2 6.58172 5.58172 3 10 3Z">
                                    </path>
                                </svg></button>
                            <p>{{ $contenu->commentaires->count() }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- PAGINATION LARAVEL NATIVE --}}
                <div class="pagination">
                    {{ $contenus->links('vendor.pagination.custom') }}
                </div>
        @else
            <!-- Message si aucun contenu -->
            <div style="text-align: center; padding: 40px; background: #f8f9fa; border-radius: 10px;">
                <h3>Aucun contenu disponible pour le moment</h3>
                <p>Soyez le premier à publier !</p>
                @auth
                    <a href="{{ route('AjoutContenu') }}" class="btn-two" style="margin-top: 20px; display: inline-block;">
                        Publier un contenu
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-two" style="margin-top: 20px; display: inline-block;">
                        Connectez-vous pour publier
                    </a>
                @endauth
            </div>
        @endif
    </div>
@endsection