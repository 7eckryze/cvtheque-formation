{{-- directive de blade spécifiant l'héritage --}}
@extends('cvtheque')

{{-- directive de blade permettant l'injection du contenu de la section : liaison avec @yield --}}
@section('contenu')

    <div class="bs-docs-section pos-bloc-section">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h4 id="tables">Fiche professionnel : Modification</h4>
                </div>
                <div class="bs-component">
                    <form action="{{ route('professionnels.update', $professionnel->id) }}" method="post" enctype="multipart/form-data">
                        {{-- METHOD ET CSRF --}}
                        @method('PUT')
                        @csrf
                        <fieldset>
                            <legend></legend>
                            <div class="form-group row">

                                <div class="col-lg-6">

                                    {{-- COMBO METIER --}}
                                    <select name="metier_id" id="metier_id" class="form-select"
                                            @error('metier_id') is-invalid @enderror>
                                        <option value="{{$professionnel->metier->id}}" selected>
                                            {{$metier}}
                                        </option>

                                        @foreach($metiers as $metier)
                                            @if($professionnel->metier->id != $metier->id)
                                            <option value="{{$metier->id}}"
                                                    @if(old('metier->id') == $metier->id) selected @endif>
                                                {{$metier->libelle}}
                                            </option>
                                            @endif
                                        @endforeach

                                    </select>
                                    @error('metier_id')
                                    <p class="text-danger" role="alert">{{$message}}</p>
                                    @enderror

                                </div>

                                <div class="col-lg-4  offset-lg-2">

                                    <div class="form-group mb-4">
                                        <div class="form-check form-check-inline">
                                            <label for="formation"><strong>Actions de formation déjà effectuées
                                                    ? </strong></label>
                                        </div>

                                        <div class="form-check">
                                            {{-- Radio 1 --}}
                                            <input type="radio" id="formation1" name="formation"
                                                   class="form-check-input" value="1"
                                                   @if(old('formation')==1 || $professionnel->formation == 1) checked @endif>
                                            <label class="form-check-label" for="formation1"> Oui (Déjà
                                                éffectuées)</label>
                                        </div>
                                        <div class="form-check">
                                            {{-- Radio 2 --}}
                                            <input type="radio" id="formation2" name="formation"
                                                   class="form-check-input" value="1"
                                                   @if(old('formation')==0 || $professionnel->formation == 0) checked @endif>
                                            <label class="form-check-label" for="formation1">Non (jamais ou trop
                                                peu)</label>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <div class="col-lg-12">
                                    <select data-none-selected-text="Compétences"
                                            data-live-search="true"
                                            class="selectpicker form-control"
                                            name="comp[]"
                                            multiple>
                                        @foreach($competences as $competence)
                                            <option value="{{$competence->id}}"
                                                {{in_array($competence->id, old('comp') ? old('comp') : $professionnel->competences->pluck('id')->toArray()) ? 'selected' : ''}}>

                                                {{$competence->intitule}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('comp')
                                    <p class="text-danger" role="alert">{{$message}}</p>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="prenom" class="col-sm-2 col-form-label">Prénom : </label>
                                <div class="col-sm-10">
                                    {{-- PRENOM --}}
                                    <input type="text" class="form-control @error('prenom') is-invalid @enderror"
                                           placeholder="Saisir un prénom" name="prenom" id="prenom"
                                           value="{{old('prenom', $professionnel->prenom)}}">
                                    @error('prenom')
                                    <p class="text-danger" role="alert">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="nom" class="col-sm-2 col-form-label">Nom : </label>
                                <div class="col-sm-10">
                                    {{-- NOM --}}
                                    <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                           placeholder="Saisir un nom" name="nom" id="nom" value="{{old('nom', $professionnel->nom)}}">
                                    @error('nom')
                                    <p class="text-danger" role="alert">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="cp" class="col-sm-2 col-form-label">Code Postal : </label>
                                <div class="col-sm-10">
                                    {{-- CP --}}
                                    <input type="text" class="form-control @error('cp') is-invalid @enderror"
                                           placeholder="Saisir un code postal" name="cp" id="cp" value="{{old('cp', $professionnel->cp)}}">
                                    @error('cp')
                                    <p class="text-danger" role="alert">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-2">
                                <label for="ville" class="col-sm-2 col-form-label">Ville : </label>
                                <div class="col-sm-10">
                                    {{-- VILLE --}}
                                    <input type="text" class="form-control @error('ville') is-invalid @enderror"
                                           placeholder="Saisir une ville" name="ville" id="ville"
                                           value="{{old('ville', $professionnel->ville)}}">
                                    @error('ville')
                                    <p class="text-danger" role="alert">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-2">
                                <label for="telephone" class="col-sm-2 col-form-label">Téléphone fixe ou portable
                                    : </label>
                                <div class="col-sm-10">
                                    {{-- TELEPHONE --}}
                                    <input type="text" class="form-control @error('telephone') is-invalid @enderror"
                                           placeholder="Saisir un téléphone" name="telephone" id="telephone"
                                           value="{{old('telephone', $professionnel->telephone)}}">
                                    @error('telephone')
                                    <p class="text-danger" role="alert">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="email" class="col-sm-2 col-form-label">Email : </label>
                                <div class="col-sm-10">
                                    {{-- EMAIL --}}
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                           placeholder="Saisir un email" name="email" id="email"
                                           value="{{old('email', $professionnel->email)}}">
                                    @error('email')
                                    <p class="text-danger" role="alert">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="naissance" class="col-sm-2 col-form-label">Date de naissance : </label>
                                <div class="col-sm-10">
                                    {{-- DATE DE NAISSANCE --}}
                                    <input type="date" class="form-control @error('naissance') is-invalid @enderror"
                                           placeholder="Saisir une date de naissance" name="naissance" id="naissance"
                                           value="{{old('naissance', $professionnel->naissance)}}">
                                    @error('naissance')
                                    <p class="text-danger" role="alert">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group mb-2">

                                <label class="col-form-label" for="domaine">Domaine de formation possible : </label>


                                <div class="form-check">
                                    {{-- DOMAINE 1 --}}
                                    <input type="checkbox" class="form-check-input" id="domaine1" name="domaine[]" value="S"
                                        {{(is_array(old('domaine', $professionnel->domaine)) && in_array('S',old('domaine', $professionnel->domaine))) ? 'checked' : ''}}>
                                    <label class="form-check-label" @error('domaine') text-danger @enderror for="domaine1">
                                        Systèmes
                                    </label>

                                </div>

                                <div class="form-check">
                                    {{-- DOMAINE 2 --}}
                                    <input type="checkbox" class="form-check-input" id="domaine2" name="domaine[]" value="R"
                                        {{(is_array(old('domaine', $professionnel->domaine)) && in_array('R',old('domaine', $professionnel->domaine))) ? 'checked' : ''}}>
                                    <label class="form-check-label" @error('domaine') text-danger @enderror for="domaine2">
                                        Réseaux
                                    </label>

                                </div>

                                <div class="form-check">
                                    {{-- DOMAINE 3 --}}
                                    <input type="checkbox" class="form-check-input" id="domaine3" name="domaine[]" value="D"
                                        {{(is_array(old('domaine', $professionnel->domaine)) && in_array('D',old('domaine', $professionnel->domaine))) ? 'checked' : ''}}>
                                    <label class="form-check-label" @error('domaine') text-danger @enderror for="domaine3">
                                        Développement
                                    </label>

                                </div>
                                @error('domaine')
                                <p class="text-danger" role="alert">{{$message}}</p>
                                @enderror
                            </div>


                            <div class="form-group row mb-2">
                                <label for="source" class="col-sm-2 col-form-label">Source : </label>
                                <div class="col-sm-10">
                                    {{-- SOURCE--}}
                                    <input type="source" class="form-control"
                                           placeholder="Réseaux sociaux, nom du partenaire,..." name="source"
                                           id="source" value="{{old('source', $professionnel->source)}}">

                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <label for="observation">Observations:</label>
                                {{-- OBSERVATION --}}
                                <textarea class="form-control" placeholder="Entrer une osbervation" name="observation"
                                          id="observation" rows="4" cols="5">{{old('observation', $professionnel->observation)}}</textarea>
                            </div>


                            <div class="form-group">
                                <label for="image">Sélectionnez votre CV au format PDF :</label>
                                <input type="file" name="pdf" accept="application/pdf">
                                <br><br>
                                @if ($errors->has('pdf'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('pdf') }}
                                    </div>
                                @endif
                            </div>






                            <a href="{{route('professionnels.index')}}" class="btn btn-primary">Retour</a>
                            <button type="submit" class="btn btn-primary float-end">Modifier</button>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <br>
    </div>

@endsection





