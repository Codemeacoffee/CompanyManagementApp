<!DOCTYPE html>
<html itemscope lang="es" dir="ltr" itemtype="https://schema.org/WebSite">
<head>
    <title>Aplicación - Fuerteventura2000</title>
    <meta name="author" content="Inversiones Borma S.L.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <!-- SEO -->
    <meta name="description" content="Acceso a la aplicación de Fuerteventura2000">
    <meta property="og:site_name" content="Fuerteventura2000">
    <meta property="og:title" content="Aplicación - Fuerteventura2000">
    <meta property="og:url" content="{{url()->full()}}">
    <meta property="og:description" content="Acceso a la aplicación de Fuerteventura2000">
    <meta property="og:image" itemprop="image" content="{{asset('images/ftv2000SEO.jpg')}}">
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="es_ES" />
    <meta property="og:updated_time" content="{{strtotime(date('Y-m-d'))}}"/>
    <!-- SEO -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/glyphicon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/utils.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/effects.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('js/jquery-ui-1.12.1/jquery-ui.min.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/style.css')}}">
    <link rel="shortcut icon" type="image/png" href= "{{asset('images/ftv2000favicon.png')}}"/>
    <link rel="preload" href="{{asset('images/loading.svg')}}" as="image">
    <script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery-ui-1.12.1/jquery-ui.min.js')}}" defer></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
</head>
<body>

<!-- L O A D I N G   L A Y E R -->

<div class="loadingLayer">
    <div class="position-relative h-100">
        <img width="25%" height="25%" class="absoluteCenterBoth" alt="Cargando, espere por favor" src="{{asset('images/loading.svg')}}">
    </div>
</div>
<script id="loadingScript" type="text/javascript">
    $(window).on("load", function () {
        $('.loadingLayer').fadeOut("slow");
        $('#loadingScript').remove();
    });
</script>

<!-- E N D   L O A D I N G   L A Y E R  -->

@if($errors->any())

    <!-- E R R O R S -->

    <div id="errorModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
            <div class="modal-content overflow-auto">
                <div class="modal-body">
                    <h2 class="text-center ml-4 mb-4">
                        <strong>Error</strong>
                        <span class="theX interactive float-right hoverRed closeUserAccess" data-dismiss="modal" aria-hidden="true">×</span>
                    </h2>
                    <div class="row"><i id="modalSignal" class="glyphicon glyphicon-alert centerHorizontal pb-4"></i></div>
                    <div class="row"><p class="text-center px-5 pb-2 w-100"><strong>{{$errors->first()}}</strong></p></div>
                </div>
            </div>
        </div>
    </div>

    <script id="errorScript" type="text/javascript">
        $('#errorModal').modal('toggle');
        $('#errorScript').remove();
    </script>

    <!-- E N D   E R R O R S -->

@endif

@if(Session::has('successMessage'))

    <!-- O T H E R   M E S S A G E S   A N D   A L T E R N A T E   B E H A V I O U R S -->

    <div id="messageModal" class="modal fade">
        <div class="modal-dialog modal-lg modal-dialog-centered modal" role="document">
            <div class="modal-content overflow-auto">
                <div class="modal-body pt-1">
                    <h2 class="text-center ml-3 mb-4">
                        <span class="theX interactive float-right hoverRed closeUserAccess dt-2" data-dismiss="modal" aria-hidden="true">×</span>
                    </h2>
                    <div class="row py-5"><i id="modalSignal" class="glyphicon glyphicon-ok centerHorizontal mb-4"></i></div>
                    <div class="row">
                        <p class="text-center px-5 w-100">
                            <strong class="py-2 d-block">{{Session::get('successMessage')}}</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script id="messageScript" type="text/javascript">
        $('#messageModal').modal('toggle');
        $('#messageScript').remove();
    </script>

    <!-- E N D   O T H E R   M E S S A G E S   A N D   A L T E R N A T E   B E H A V I O U R S -->

@endif

<!-- A C C E S S   F O R M -->

<div class="container-fluid centerVertical position-relative access">
    <div class="row">
        <div class="col-lg-4 offset-lg-4 col-md-8 offset-md-2 col-12 bg-deep-blue rounded shadow py-4 px-5">
            <form class="w-100" method="post" action="{{url('validateAccess')}}">
                {{csrf_field()}}
                <h2 class="text-center text-white mb-2"><strong>Acceso</strong></h2>
                <div class="form-group mb-4">
                    <label for="user"><strong class="text-white">Usuario</strong></label>
                    <input type="text" class="form-control" id="user" name="user" required>
                </div>
                <div class="form-group mb-4">
                    <label for="password"><strong class="text-white">Contraseña</strong></label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn bg-white centerHorizontal"><strong class="color-deep-blue">Acceder</strong></button>
            </form>
        </div>
    </div>
</div>

<div class="layer baseLayer"></div>
<div class="layer colorLayer"></div>

<!-- E N D   A C C E S S   F O R M -->



</body>
</html>
