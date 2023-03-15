{{-- directive de blade spécifiant l'héritage --}}
@extends('cvtheque')

{{-- directive de blade permettant l'injection du contenu de la section : liaison avec @yield --}}
@section('contenu')

    <div class="bs-docs-section pos-bloc-section">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h4 id="tables">Fiche métier : Modification</h4>
                </div>
                <div class="bs-component">
                    <form method="post" action="{{route('metiers.update', $metier->id)}}">
                        @method('PUT')
                        @csrf
                        <fieldset>
                            <legend></legend>
                            <div class="form-group row">
                                <label for="libelle" class="col-sm-2 col-form-label">Libellé : </label>
                                <div class="col-sm-10">
                                    <input type="text"
                                           class="form-control @error('libelle') border-danger @enderror"
                                           id="libelle"
                                           name="libelle"
                                           placeholder="Libellé du métier"
                                           value="{{old('libelle', $metier->libelle)}}">
                                    @error('libelle')
                                    <p class="text-danger" role="alert">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
<br>
                            <div class="form-group row">
                                <label for="slug" class="col-sm-2 col-form-label">Slug : </label>
                                <div class="col-sm-10">
                                    <input type="text"
                                           class="form-control @error('slug') border-danger @enderror"
                                           id="slug"
                                           name="slug"
                                           placeholder="Slug du métier"
                                           value="{{old('slug', $metier->slug)}}">
                                    @error('slug')
                                    <p class="text-danger" role="alert">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-sm-2 col-form-label">Description :</label>
                                <textarea class="form-control @error('description') border-danger @enderror"
                                          id="description"
                                          name="description"
                                          placeholder="Description du métier"
                                          rows="3">{{old('description', $metier->description)}}</textarea>
                                @error('description')
                                <p class="text-danger" role="alert">{{$message}}</p>
                                @enderror
                            </div>




                            <div class="pos-bloc-section">
                                <a href="{{route('metiers.index')}}" class="btn btn-primary">Retour</a>
                                <button type="submit" class="btn btn-success float-end">Enregistrer</button>
                            </div>

                        </fieldset>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection


