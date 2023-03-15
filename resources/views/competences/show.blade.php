{{-- directive de blade spécifiant l'héritage --}}
@extends('cvtheque')

{{-- directive de blade permettant l'injection du contenu de la section : liaison avec @yield --}}
@section('contenu')


    <div class="bs-docs-section pos-bloc-section">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h4 id="tables">Fiche compétence : Consultation</h4>
                </div>
                <div class="bs-component">
                    <form>
                        <fieldset>
                            <legend></legend>
                            <div class="form-group row">
                                <label for="intitule" class="col-sm-2 col-form-label">Intitulé : </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly="" class="form-control" id="intitule"
                                           name="intitule" value="{{$competence->intitule}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description"  class="col-sm-2 col-form-label">Descriptif :</label>
                                <textarea readonly class="form-control"
                                          id="description"
                                          name="description"
                                          rows="3">{{$competence->description}}</textarea>
                            </div>


                            <div class="pos-bloc-section">
                                <a href="{{route('competences.index')}}" class="btn btn-primary">Retour</a>
                            </div>
                        </fieldset>
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection

