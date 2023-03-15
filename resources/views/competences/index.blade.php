{{--Directive Blade spécifiant l'héritage--}}
@extends('cvtheque')

{{--Directive Blade spécifiant l'injection du contenu de la section vers une liaison @yield()'--}}
@section('contenu')

    <div class="bs-docs-section pos-bloc-section">
        <div class="row">
                        <div class="col-lg-10">

                        </div>
            <div class="col-lg-2 ">
                <a href="{{route('competences.create')}}" class="btn btn-primary float-right">Créer une compétence</a>
            </div>
        </div>
    </div>

    {{-- ICI LA GESTION DES MESSAGES D'INFORMATION  --}}
    @if(session('information'))
        <div class="bs-docs-section pos-bloc-section">
            <div class="alert alert-dismissible alert-success">
                <h4 class="alert-heading">Information : </h4>
                <p class="mb-0">
                    {{session('information')}}
                </p>
            </div>
        </div>
    @endif
    {{-- FIN GESTION INFO --}}
            <div class="col-lg-12">
                <div class="page-header">
                    <h4 id="tables">Listes des compétences</h4>
                </div>

                <div class="bs-component">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Numéro</th>
                            <th scope="col">Intitulé</th>
                            <th scope="col" colspan="3"></th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--BOUCLE POUR RECUPERATION DES COMPTENCES --}}
                        @foreach($competences as $competence)
                            <tr>
                                <td>{{$competence->id}}</td>
                                <td>{{$competence->intitule}}</td>
                                <td>
                                    <form action="{{route('competences.show', $competence->id)}}" method="post">
                                        @method('GET')
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Consulter</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('competences.edit', $competence->id)}}" method="post">
                                        @method('GET')
                                        @csrf
                                        <button type="submit" class="btn btn-warning">Modifier</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('competences.destroy', $competence->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        {{-- FIN BOUCLE --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection




