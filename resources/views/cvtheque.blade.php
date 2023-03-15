<!DOCTYPE html>
<html lang="{{str_replace('_','-', app()->getLocale())}}">
<head>
    <!--    Repose sur : https://bootswatch.com/slate/-->
    <meta charset="UTF-8">
    <title>{{$title ?? ''}}</title>
    <meta name="description" content="{{$description ?? ''}}">

    <!--    OU-->
    <link rel="stylesheet" href="{{asset('css/_bootswatch.scss')}}">
    <link rel="stylesheet" href="{{asset('css/_variables.scss')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.home.css')}}">

    <link rel="shorcut icon" href="{{asset('images/cvtheque.png')}}">


    <!-- Latest compiled and minified CSS select multiple-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
</head>

<body>


<div class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
    <div class="container">
        <a href="{{route('accueil')}}" class="navbar-brand">Accueil</a>
        <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>-->
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Themes <span
                            class="caret"></span></a>
                    <div class="dropdown-menu" aria-labelledby="themes">
                        <a class="dropdown-item" href="../default/">Default</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../cerulean/">Cerulean</a>
                        <a class="dropdown-item" href="../cosmo/">Cosmo</a>

                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../help/">Help</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://blog.bootswatch.com/">Blog</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="download">Paramètres<span
                            class="caret"></span></a>
                    <div class="dropdown-menu" aria-labelledby="download">
                        <a class="dropdown-item" href="{{route('competences.index')}}">Compétences</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('metiers.index')}}">Métiers</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="container pos-top">

    <div class="bs-docs-section pos-bloc-section">
        <div class="page-header" id="banner">
            <div class="row">
                <div class="col-lg-8 col-md-7 col-sm-6">
                    <h1>MA CVTHEQUE</h1>
                    <p class="lead">Pour la formation</p>
                </div>
                <div class="col-lg-4 col-md-5 col-sm-6">
                    <div class="sponsor">

                        {{--                        <script async src="https://cdn.carbonads.com/carbon.js?serve=CKYIE23N&placement=bootswatchcom"--}}
                        {{--                                id="_carbonads_js"></script>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{--    ICI CONTENU --}}
    @yield('contenu')


</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
</body>
</html>
