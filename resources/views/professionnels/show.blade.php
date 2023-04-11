{{-- directive de blade spécifiant l'héritage --}}
@extends('cvtheque')

{{-- directive de blade permettant l'injection du contenu de la section : liaison avec @yield --}}
@section('contenu')

    <div class="bs-docs-section pos-bloc-section">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h4 id="tables">Fiche professionnel : Consultation</h4>
                </div>
                <div class="bs-component">
                    <form method="post">
                        {{-- METHOD ET CSRF --}}
                        @method('POST')
                        @csrf
                        <fieldset>
                            <legend></legend>
                            <div class="form-group row">

                                <div class="col-lg-6">

                                    {{-- COMBO METIER --}}
                                    {{$professionnel->metier->libelle}}

                                </div>

                                <div class="col-lg-4  offset-lg-2">

                                    <div class="form-group mb-4">
                                        <div class="form-check form-check-inline">
                                            <label for="formation"><strong>Actions de formation déjà effectuées
                                                    ? </strong></label>
                                        </div>

                                        @if($professionnel->formation == 1)
                                            <p>Formation effectué</p>
                                        @else
                                            <p>Formation non effectué</p>
                                        @endif


                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <h4>Les compétences</h4>
                                    @forelse($professionnel->competences as $uneCompetence)
                                        - {{$uneCompetence->intitule}}<br>
                                    @empty
                                        - Aucune compétence -


                                    @endforelse

                                </div>


                            </div>


                            <div class="form-group row mb-2">
                                <label for="prenom" class="col-sm-2 col-form-label">Prénom : </label>
                                <div class="col-sm-10">
                                    {{-- PRENOM --}}
                                    <input type="text" class="form-control"
                                           placeholder="Saisir un prénom" name="prenom" id="prenom"
                                           value="{{$professionnel->prenom}}" readonly>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="nom" class="col-sm-2 col-form-label">Nom : </label>
                                <div class="col-sm-10">
                                    {{-- NOM --}}
                                    <input type="text" class="form-control"
                                           placeholder="Saisir un nom" name="nom" id="nom"
                                           value="{{$professionnel->nom}}" readonly>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="cp" class="col-sm-2 col-form-label">Code Postal : </label>
                                <div class="col-sm-10">
                                    {{-- CP --}}
                                    <input type="text" class="form-control"
                                           placeholder="Saisir un code postal" name="cp" id="cp"
                                           value="{{$professionnel->cp}}" readonly>
                                </div>
                            </div>


                            <div class="form-group row mb-2">
                                <label for="ville" class="col-sm-2 col-form-label">Ville : </label>
                                <div class="col-sm-10">
                                    {{-- VILLE --}}
                                    <input type="text" class="form-control"
                                           placeholder="Saisir une ville" name="ville" id="ville"
                                           value="{{$professionnel->ville}}" readonly>
                                </div>
                            </div>


                            <div class="form-group row mb-2">
                                <label for="telephone" class="col-sm-2 col-form-label">Téléphone fixe ou portable
                                    : </label>
                                <div class="col-sm-10">
                                    {{-- TELEPHONE --}}
                                    <input type="text" class="form-control"
                                           placeholder="Saisir un téléphone" name="telephone" id="telephone"
                                           value="{{$professionnel->telephone}}" readonly>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="email" class="col-sm-2 col-form-label">Email : </label>
                                <div class="col-sm-10">
                                    {{-- EMAIL --}}
                                    <input type="text" class="form-control"
                                           placeholder="Saisir un email" name="email" id="email"
                                           value="{{$professionnel->email}}" readonly>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="naissance" class="col-sm-2 col-form-label">Date de naissance : </label>
                                <div class="col-sm-10">
                                    {{-- DATE DE NAISSANCE --}}
                                    <input type="date" class="form-control"
                                           placeholder="Saisir une date de naissance" name="naissance" id="naissance"
                                           value="{{$professionnel->naissance}}" readonly>
                                </div>
                            </div>


                            <div class="form-group mb-2">

                                <label class="col-form-label" for="domaine">Domaine de formation possible : </label>

                                @if(is_array($professionnel->domaine) && in_array('S', $professionnel->domaine))
                                    <br>
                                    - Systèmes
                                @endif
                                @if(is_array($professionnel->domaine) && in_array('R' ,$professionnel->domaine))
                                    <br>
                                    - Réseaux
                                @endif
                                @if(is_array($professionnel->domaine) && in_array('D' ,$professionnel->domaine))
                                    <br>
                                    - Développement
                                @endif

                            </div>
                </div>


                <div class="form-group row mb-2">
                    <label for="source" class="col-sm-2 col-form-label">Source : </label>
                    <div class="col-sm-10">
                        {{-- SOURCE--}}
                        <input type="source" class="form-control"
                               placeholder="Réseaux sociaux, nom du partenaire,..." name="source"
                               id="source" value="{{$professionnel->source}}" readonly>

                    </div>
                </div>

                <div class="form-group mb-2">
                    <label for="observation">Observations:</label>
                    {{-- OBSERVATION --}}
                    <textarea class="form-control" placeholder="Entrer une osbervation" name="observation"
                              id="observation" rows="4" cols="5" readonly>{{$professionnel->observation}}</textarea>
                </div>

                @if($professionnel->pdf)
                    <div class="form-group">
                        <a href="{{ asset('storage/pdf/' . $professionnel->pdf) }}" class="btn btn-primary" download>Télécharger le CV (.pdf)</a>
                    </div>
                @endif
<br>


                <a href="{{route('professionnels.index')}}" class="btn btn-primary">Retour</a>

                </fieldset>
                </form>
            </div>
        </div>
    </div>
    <br>
    </div>

@endsection





