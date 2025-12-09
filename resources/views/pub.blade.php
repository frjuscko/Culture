@extends('contributeur')
@section('content')

<div class="publication-form">
    <h2>📝 Publier un nouveau contenu</h2>

    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('contenu.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="input-group">
            <label>Titre *</label>
            <input type="text" name="titre" value="{{ old('titre') }}" required>
        </div>

        <div class="input-group">
            <label>Contenu *</label>
            <textarea name="texte" rows="10" required>{{ old('texte') }}</textarea>
        </div>

        <div class="form-row">
            <div class="input-group">
                <label>Région *</label>
                <select name="region" required>
                    <option value="">Sélectionnez une région</option>
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}">{{ $region->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-group">
                <label>Langue *</label>
                <select name="langue" required>
                    <option value="">Sélectionnez une langue</option>
                    @foreach($langues as $langue)
                        <option value="{{ $langue->id }}">{{ $langue->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-group">
                <label>Type de contenu *</label>
                <select name="type" required>
                    <option value="">Sélectionnez un type</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->libelle }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Nouveau champ d'upload stylisé -->
        <div class="input-group">
            <label>Fichiers (Images/Vidéos)</label>
            <div class="upload-area" id="uploadArea">
                <input type="file" name="fichiers[]" id="fileInput" multiple accept=".jpg,.jpeg,.png,.gif,.mp4,.avi,.mov">
                <div class="upload-icon">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
                <div class="upload-text">Glissez-déposez vos fichiers ici</div>
                <div class="upload-subtext">ou <span class="browse-button">parcourir</span> depuis votre appareil</div>
                <div class="upload-subtext">Formats acceptés: JPG, PNG, GIF, MP4, AVI, MOV. Max: 10MB par fichier</div>
            </div>
            <div class="file-list" id="fileList"></div>
        </div>

        <div class="input-group">
            <label>Traduction (optionnel)</label>
            <select name="parent_id">
                <option value="">Nouveau contenu (pas une traduction)</option>
                <!-- Ici tu peux ajouter une liste des contenus existants pour traduire -->
            </select>
            <small>Si c'est une traduction, sélectionnez le contenu original</small>
        </div>

        <button type="submit" class="btn-primary">Publier le contenu</button>
    </form>
</div>

{{-- Inclure le fichier JavaScript --}}
    <script src="{{ URL::asset('backend/js/pubcontenu.js') }}"></script>

@endsection