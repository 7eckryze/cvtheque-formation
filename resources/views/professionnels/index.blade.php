{{--Directive Blade spécifiant l'héritage--}}
@extends('cvtheque')

{{--Directive Blade spécifiant l'injection du contenu de la section vers une liaison @yield()'--}}
@section('contenu')

    <div class="bs-docs-section pos-bloc-section">
        <div class="row">
            <div class="col-lg-10">
                <select onchange="location.href=this.value" name="metiers" id="metiers">
                    <option value="{{route('professionnels.index')}}" @unless($slug) selected @endunless>
                        Tous les métiers
                    </option>
                    @foreach($metiers as $metier)
                        <option value="{{route('professionnels.metier', ['slug'=>$metier->slug])}}"
                            {{$slug == $metier->slug ? 'selected' : ''}}>
                            {{$metier->libelle}}</option>
                    @endforeach
                </select>

                <form method="post" action="{{route('professionnels.index')}}">
                    @method('GET')
                    @csrf
                    <div class="row">
                        <div class="col-lg-9">
                            <input type="text" name="comp" class="form-control" id="comp" value="{{$comp}}"
                                   placeholder="Rechercher des professionnels en fonction de leurs compétences">
                        </div>
                        <div class="col-lg-1">
                            <button type="submit" class="btn btn-danger">Rechercher</button>
                        </div>
                    </div>
                </form>


            </div>
            <div class="col-lg-2 ">
                <a href="{{route('professionnels.create')}}" class="btn btn-primary float-right">Créer un
                    professionnel</a>
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
            <h4 id="tables">Listes des professionnels</h4>
        </div>

        <div class="bs-component">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Identifiant</th>
                    <th scope="col">Prénom et nom</th>
                    <th scope="col">Métier exercé</th>
                    <th scope="col">Domiciliation</th>
                    <th scope="col">Formation</th>
                    <th scope="col" colspan="3"></th>
                </tr>
                </thead>
                <tbody>
                {{--BOUCLE POUR RECUPERATION DES COMPTENCES --}}
                @forelse($professionnels as $professionnel)
                    <tr>
                        <td>{{$professionnel->id}}</td>
                        <td>{{$professionnel->prenom}} {{$professionnel->nom}}</td>
                        <td>{{$professionnel->metier->libelle}}</td>
                        <td>{{$professionnel->cp}} {{$professionnel->ville}}</td>
                        <td>@if($professionnel->formation == 0)
                                Non
                            @else
                                Oui
                            @endif</td>
                        <td>
                            <form action="{{route('professionnels.show', $professionnel->id)}}" method="post">
                                @method('GET')
                                @csrf
                                <button type="submit" class="btn btn-primary">Consulter</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{route('professionnels.edit', $professionnel->id)}}" method="post">
                                @method('GET')
                                @csrf
                                <button type="submit" class="btn btn-warning">Modifier</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{route('professionnels.destroy', $professionnel->id)}}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">Aucun professionnel enregistré</td>
                    </tr>
                @endforelse

                {{-- FIN BOUCLE --}}
                </tbody>
            </table>
            <footer class="pagination center justify-content-center">
                {{$professionnels->links()}}
            </footer>
        </div>
    </div>
    </div>
    </div>
@endsection





