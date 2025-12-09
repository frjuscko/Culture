@extends('dashTwo')
@section('content')

    {{-- Messages de succès --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Messages d'erreur --}}
    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if (Auth::user()->isContributeur())
        <div class="head">
            <a href="{{ route('AjoutContenu') }}" class="btn-two" style="margin-top: 20px; display: inline-block;">
                Publier un contenu
            </a>
            <div class="search-bar">
                <form action="{{ route('mescontenus') }}" method="GET">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Rechercher..." class="search-input">
                    <button type="submit" class="search-btn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path
                                d="M11 2C15.968 2 20 6.032 20 11C20 15.968 15.968 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2ZM11 18C14.8675 18 18 14.8675 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18ZM19.4853 18.0711L22.3137 20.8995L20.8995 22.3137L18.0711 19.4853L19.4853 18.0711Z">
                            </path>
                        </svg></button>
                </form>
            </div>
        </div>
    @endif
    <div class="contenus">
        @if (Auth::user()->isContributeur())
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
                                {{-- Description limitée à 150 caractères --}}
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
                    <p>Publiez votre premier contenu !</p>
                    @auth
                        <a href="{{ route('AjoutContenu') }}" class="btn-two" style="margin-top: 20px; display: inline-block;">
                            Publier un contenu
                        </a>
                    @endauth
                </div>
            @endif
        @endif
        @if (Auth::user()->isModerator())
            @if ($NVcontenus->count() > 0)
                <div class="contenu-cards">
                    @foreach ($NVcontenus as $contenu)
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
                                {{-- Description limitée à 150 caractères --}}
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
                                <p>
                                    <form action="{{ route('contenu.val') }}" method="POST">
                                        @csrf
                                        <input type="number" name="id" id="" value="{{ $contenu->id }}"class="invisible">
                                        <button type="submit" class="btn-val">Valider</button>
                                    </form>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- PAGINATION LARAVEL NATIVE --}}
                <div class="pagination">
                    {{ $NVcontenus->links('vendor.pagination.custom') }}
                </div>
            @else
                <!-- Message si aucun contenu -->
                <div style="text-align: center; padding: 40px; background: #f8f9fa; border-radius: 10px;">
                    <h3>Aucun contenu en atente pour le moment</h3>
                </div>
            @endif
        @endif
    </div>

    <script src="{{ URL::asset('backend/js/contenus.js') }}"></script>
@endsection