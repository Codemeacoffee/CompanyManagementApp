@section('header')
    <!DOCTYPE html>
<html itemscope lang="es" dir="ltr" itemtype="https://schema.org/WebSite">
<head>
    <title>@yield('title')</title>
    <meta name="author" content="Inversiones Borma S.L.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <!-- SEO -->
    <meta name="description" content="@yield('description')">
    <meta property="og:site_name" content="Fuerteventura2000">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:url" content="{{url()->full()}}">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:image" itemprop="image" content="@yield('img')">
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="es_ES" />
    <meta property="og:updated_time" content="{{strtotime(date('Y-m-d'))}}"/>
    <!-- SEO -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/glyphicon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/utils.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/effects.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/fontawesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" type="text/css" href="{{asset('css/sb-admin-2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('js/jquery-ui-1.12.1/jquery-ui.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/datatables.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/style.css')}}">
    <link rel="shortcut icon" type="image/png" href= "{{asset('images/ftv2000favicon.png')}}"/>
    <link rel="preload" href="{{asset('images/loading.svg')}}" as="image">
    <script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script type="text/javascript" src="{{asset('js/jquery-ui-1.12.1/jquery-ui.min.js')}}" defer></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/datatables.js')}}" defer></script>
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

<!--@if($errors->any())-->

    <!-- E R R O R S -->

<!--    <div id="errorModal" class="modal fade">-->
<!--        <div class="modal-dialog modal-dialog-centered modal" role="document">-->
<!--            <div class="modal-content overflow-auto">-->
<!--                <div class="modal-body">-->
<!--                    <h2 class="text-center ml-4 mb-4">-->
<!--                        <strong>Error</strong>-->
<!--                        <span class="theX interactive float-right hoverRed closeUserAccess" data-dismiss="modal" aria-hidden="true">×</span>-->
<!--                    </h2>-->
<!--                    <div class="row"><i id="modalSignal" class="glyphicon glyphicon-alert centerHorizontal pb-4"></i></div>-->
<!--                    <div class="row"><p class="text-center px-5 pb-2 w-100"><strong>{{$errors->first()}}</strong></p></div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

<!--    <script id="errorScript" type="text/javascript">-->
<!--        $('#errorModal').modal('toggle');-->
<!--        $('#errorScript').remove();-->
<!--    </script>-->

    <!-- E N D   E R R O R S -->

<!--@endif-->

<!--@if(Session::has('successMessage'))-->

    <!-- O T H E R   M E S S A G E S   A N D   A L T E R N A T E   B E H A V I O U R S -->

<!--    <div id="messageModal" class="modal fade">-->
<!--        <div class="modal-dialog modal-lg modal-dialog-centered modal" role="document">-->
<!--            <div class="modal-content overflow-auto">-->
<!--                <div class="modal-body pt-1">-->
<!--                    <h2 class="text-center ml-3 mb-4">-->
<!--                        <span class="theX interactive float-right hoverRed closeUserAccess dt-2" data-dismiss="modal" aria-hidden="true">×</span>-->
<!--                    </h2>-->
<!--                    <div class="row py-5"><i id="modalSignal" class="glyphicon glyphicon-ok centerHorizontal mb-4"></i></div>-->
<!--                    <div class="row">-->
<!--                        <p class="text-center px-5 w-100">-->
<!--                            <strong class="py-2 d-block">{{Session::get('successMessage')}}</strong>-->
<!--                        </p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

<!--    <script id="messageScript" type="text/javascript">-->
<!--        $('#messageModal').modal('toggle');-->
<!--        $('#messageScript').remove();-->
<!--    </script>-->

    <!-- E N D   O T H E R   M E S S A G E S   A N D   A L T E R N A T E   B E H A V I O U R S -->

<!--@endif-->

<div class="modal fade" id="addIncidence" tabindex="-1" role="dialog" aria-labelledby="Modal for adding an incidence" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('createIncidence')}}">
                {{csrf_field()}}
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 text-center color-black"><strong>Añadir incidencia</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5">
                    <label for="incidence" class="color-black"><h6 title="Este campo es obligatorio">Incidencia<span class="text-danger">*</span></h6></label>
                    <input id="incidence" class="form-control mb-2" type="text" name="incidence" required>
                    <label for="informant" class="color-black"><h6 title="Este campo es obligatorio">Informante<span class="text-danger">*</span></h6></label>
                    <input id="informant" class="form-control mb-2" type="text" name="informant" required>
                    <label for="code" class="color-black"><h6 title="Este campo es opcional">Código de equipo</h6></label>
                    <input id="code" class="form-control mb-2" type="text" name="code">
                    <label for="code" class="color-black"><h6 title="Este campo es obligatorio">Fecha de incidencia<span class="text-danger">*</span></h6></label>
                    <input type="date" class="form-control mb-2" id="incidence_date" name="incidence_date" required>
                    <label for="observations" class="color-black"><h6 title="Este campo es opcional">Observaciones</h6></label>
                    <textarea id="observations" class="form-control mb-2 row-4" type="text" name="observations"></textarea>
                    <label for="location" class="color-black"><h6 title="Este campo es obligatorio">Sede<span class="text-danger">*</span></h6></label>
                    <select class="form-control" name="location" required>
                        <option value="" disabled selected>Seleccione la sede</option>
                        <option value="GRAN CANARIA 54">Gran Canaria 54</option>
                        <option value="GRAN CANARIA 70">Gran Canaria 70</option>
                        <option value="CISNEROS 82">Cisneros 82</option>
                        <option value="CISNEROS 105">Cisneros 105</option>
                        <option value="MAHAN 104">Mahan 104</option>
                        <option value="BARSINA 12">Barsina 12</option>
                        <option value="PIZARRO 45">Pizarro 45</option>
                        <option value="CANELEJAS">Canelejas</option>
                        <option value="ANTIGUA">Antigua</option>
                        <option value="FERNANDO GUANARTEME 44">Fernando Guanarteme 44</option>
                        <option value="PLAZA ALONSO QUESADA">Plaza Alonso Quesada</option>
                        <option value="RUFINO 7">Rufino 7</option>
                        <option value="PARADOR DE FUERTEVENTURA">Parador de Fuerteventura</option>
                        <option value="HOTEL ESCUELA PAJARA">Hotel Escuela Pajara</option>
                        <option value="PEREZ DEL TORO 54">Perez del Toro</option>
                        <option value="CHT">CHT</option>
                        <option value="ATALAYA 15">Atalaya 15</option>
                        <option value="PEROJO 16">Perojo 16</option>
                        <option value="AYAGUARES 9">Ayaguares 9</option>
                        <option value="JOAQUIN BLANCO TORRENT">Joaquin Blanco Torrent</option>
                        <option value="JUAN DOMINGUEZ PEÑA">Juan Dominguez Peña</option>
                    </select>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 noScriptDisplayNone toggleGeneric" data-dismiss="modal"><strong>Cancelar</strong></button>
                    <noscript>
                        <a href="{{url()->full()}}"><button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 toggleGeneric" ><strong>Cancelar</strong></button></a>
                    </noscript>
                    <button type="submit" class="btn cpBtn bg-deep-blue text-white border-deep-blue px-4 toggleContent" ><strong>Enviar</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addComputer" tabindex="-1" role="dialog" aria-labelledby="Modal for adding a computer" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('createComputer')}}">
                {{csrf_field()}}
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 text-center color-black"><strong>Añadir equipo</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5">
                    <div class="content-fluid">
                        <div class="row">
                            <div class="col-4">
                                <label for="code" class="color-black"><h6 title="Este campo es obligatorio">Código<span class="text-danger">*</span></h6></label>
                                <input id="code" class="form-control mb-2" type="text" name="code" required>
                            </div>
                            <div class="col-4">
                                <label for="name" class="color-black"><h6 title="Este campo es obligatorio">Nombre<span class="text-danger">*</span></h6></label>
                                <input id="name" class="form-control mb-2" type="text" name="name" required>
                            </div>
                            <div class="col-4">
                                <label for="brand" class="color-black"><h6 title="Este campo es opcional">Marca</h6></label>
                                <input id="brand" class="form-control mb-2" type="text" name="brand">
                            </div>
                            <div class="col-4">
                                <label for="model" class="color-black"><h6 title="Este campo es opcional">Modelo</h6></label>
                                <input id="model" class="form-control mb-2" type="text" name="model">
                            </div>
                            <div class="col-4">
                                <label for="serial" class="color-black"><h6 title="Este campo es obligatorio">Número de serie<span class="text-danger">*</span></h6></label>
                                <input id="serial" class="form-control mb-2" type="text" name="serial" required>
                            </div>
                            <div class="col-4">
                                <label for="ip" class="color-black"><h6 title="Este campo es obligatorio">IP<span class="text-danger">*</span></h6></label>
                                <input id="ip" class="form-control mb-2" type="text" name="ip" required>
                            </div>
                            <div class="col-4">
                                <label for="processor" class="color-black"><h6 title="Este campo es obligatorio">Procesador<span class="text-danger">*</span></h6></label>
                                <input id="processor" class="form-control mb-2" type="text" name="processor" required>
                            </div>
                            <div class="col-4">
                                <label for="memory" class="color-black"><h6 title="Este campo es obligatorio">Memoria<span class="text-danger">*</span></h6></label>
                                <input id="memory" class="form-control mb-2" type="text" name="memory" required>
                            </div>
                            <div class="col-4">
                                <label for="hardDrive" class="color-black"><h6 title="Este campo es obligatorio">Disco duro<span class="text-danger">*</span></h6></label>
                                <input id="hardDrive" class="form-control mb-2" type="text" name="hardDrive" required>
                            </div>
                            <div class="col-4">
                                <label for="operatingSystem" class="color-black"><h6 title="Este campo es obligatorio">Sistema operativo<span class="text-danger">*</span></h6></label>
                                <input id="operatingSystem" class="form-control mb-2" type="text" name="operatingSystem" required>
                            </div>
                            <div class="col-4">
                                <label for="CD_ROM" class="color-black"><h6 title="Este campo es obligatorio">CD-ROM<span class="text-danger">*</span></h6></label>
                                <select class="form-control" name="CD_ROM" required>
                                    <option value="" disabled selected>Seleccione si tiene CD-Rom</option>
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="status" class="color-black"><h6 title="Este campo es obligatorio">Estado<span class="text-danger">*</span></h6></label>
                                <input id="status" class="form-control mb-2" type="text" name="status" required>
                            </div>
                            <div class="col-4">
                                <label for="location" class="color-black"><h6 title="Este campo es obligatorio">Sede<span class="text-danger">*</span></h6></label>
                                <select class="form-control" name="location" required>
                                    <option value="" disabled selected>Seleccione la sede</option>
                                    <option value="GRAN CANARIA 54">Gran Canaria 54</option>
                                    <option value="GRAN CANARIA 70">Gran Canaria 70</option>
                                    <option value="CISNEROS 82">Cisneros 82</option>
                                    <option value="CISNEROS 105">Cisneros 105</option>
                                    <option value="MAHAN 104">Mahan 104</option>
                                    <option value="BARSINA 12">Barsina 12</option>
                                    <option value="PIZARRO 45">Pizarro 45</option>
                                    <option value="CANELEJAS">Canelejas</option>
                                    <option value="ANTIGUA">Antigua</option>
                                    <option value="FERNANDO GUANARTEME 44">Fernando Guanarteme 44</option>
                                    <option value="PLAZA ALONSO QUESADA">Plaza Alonso Quesada</option>
                                    <option value="RUFINO 7">Rufino 7</option>
                                    <option value="PARADOR DE FUERTEVENTURA">Parador de Fuerteventura</option>
                                    <option value="HOTEL ESCUELA PAJARA">Hotel Escuela Pajara</option>
                                    <option value="PEREZ DEL TORO 54">Perez del Toro</option>
                                    <option value="CHT">CHT</option>
                                    <option value="ATALAYA 15">Atalaya 15</option>
                                    <option value="PEROJO 16">Perojo 16</option>
                                    <option value="AYAGUARES 9">Ayaguares 9</option>
                                    <option value="JOAQUIN BLANCO TORRENT">Joaquin Blanco Torrent</option>
                                    <option value="JUAN DOMINGUEZ PEÑA">Juan Dominguez Peña</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="originalPlacement" class="color-black"><h6 title="Este campo es opcional">Ubicación</h6></label>
                                <input id="originalPlacement" class="form-control mb-2" type="text" name="originalPlacement">
                            </div>
                            <div class="col-4">
                                <label for="currentPlacement" class="color-black"><h6 title="Este campo es opcional">Ubicación actual</h6></label>
                                <input id="currentPlacement" class="form-control mb-2" type="text" name="currentPlacement">
                            </div>
                            <div class="col-4">
                                <label for="observations" class="color-black"><h6 title="Este campo es opcional">Observaciones</h6></label>
                                <textarea id="observations" class="form-control mb-2 row-4" type="text" name="observations"></textarea>
                            </div>
                            <div class="col-4">
                                <label for="deceased" class="color-black"><h6 title="Este campo es obligatorio">Baja<span class="text-danger">*</span></h6></label>
                                <select class="form-control" name="deceased" required>
                                    <option value="" disabled selected>Seleccione si está de baja o no</option>
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="deceaseDate" class="color-black"><h6 title="Este campo es opcional">Fecha de baja</h6></label>
                                <input id="deceaseDate" class="form-control mb-2" type="date" name="deceaseDate">
                            </div>
                            <div class="col-4">
                                <label for="warranty" class="color-black"><h6 title="Este campo es obligatorio">Garantía<span class="text-danger">*</span></h6></label>
                                <select class="form-control" name="warranty" required>
                                    <option value="" disabled selected>Seleccione si tiene garantía o no</option>
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="warrantyEndDate" class="color-black"><h6 title="Este campo es opcional">Fin de garantía</h6></label>
                                <input id="warrantyEndDate" class="form-control mb-2" type="date" name="warrantyEndDate">
                            </div>
                            <div class="col-4">
                                <label for="provider" class="color-black"><h6 title="Este campo es opcional">Proveedor</h6></label>
                                <input id="provider" class="form-control mb-2" type="text" name="provider">
                            </div>
                            <div class="col-4">
                                <label for="gateway" class="color-black"><h6 title="Este campo es opcional">Puerta de enlace</h6></label>
                                <input id="gateway" class="form-control mb-2" type="text" name="gateway">
                            </div>
                            <div class="col-4">
                                <label for="DNS1" class="color-black"><h6 title="Este campo es opcional">DNS1</h6></label>
                                <input id="DNS1" class="form-control mb-2" type="text" name="DNS1">
                            </div>
                            <div class="col-4">
                                <label for="DNS2" class="color-black"><h6 title="Este campo es opcional">DNS2</h6></label>
                                <input id="DNS2" class="form-control mb-2" type="text" name="DNS2">
                            </div>
                            <div class="col-4">
                                <label for="purchaseDate" class="color-black"><h6 title="Este campo es obligatorio">Fecha de compra<span class="text-danger">*</span></h6></label>
                                <input id="purchaseDate" class="form-control mb-2" type="date" name="purchaseDate" required>
                            </div>
                            <div class="col-4">
                                <label for="activationKey" class="color-black"><h6 title="Este campo es opcional">Clave de activación Windows</h6></label>
                                <input id="activationKey" class="form-control mb-2" type="text" name="activationKey">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 noScriptDisplayNone toggleGeneric" data-dismiss="modal"><strong>Cancelar</strong></button>
                    <noscript>
                        <a href="{{url()->full()}}"><button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 toggleGeneric" ><strong>Cancelar</strong></button></a>
                    </noscript>
                    <button type="submit" class="btn cpBtn bg-deep-blue text-white border-deep-blue px-4 toggleContent" ><strong>Enviar</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addAudit" tabindex="-1" role="dialog" aria-labelledby="Modal for adding an audit" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('createAudit')}}">
                {{csrf_field()}}
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 text-center color-black"><strong>Añadir Auditoría</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5">
                    <label for="location" class="color-black"><h6 title="Este campo es obligatorio">Sede<span class="text-danger">*</span></h6></label>
                    <select class="form-control mb-2" name="location" required>
                        <option value="" disabled selected>Seleccione la sede</option>
                        <option value="GRAN CANARIA 54">Gran Canaria 54</option>
                        <option value="GRAN CANARIA 70">Gran Canaria 70</option>
                        <option value="CISNEROS 82">Cisneros 82</option>
                        <option value="CISNEROS 105">Cisneros 105</option>
                        <option value="MAHAN 104">Mahan 104</option>
                        <option value="BARSINA 12">Barsina 12</option>
                        <option value="PIZARRO 45">Pizarro 45</option>
                        <option value="CANELEJAS">Canelejas</option>
                        <option value="ANTIGUA">Antigua</option>
                        <option value="FERNANDO GUANARTEME 44">Fernando Guanarteme 44</option>
                        <option value="PLAZA ALONSO QUESADA">Plaza Alonso Quesada</option>
                        <option value="RUFINO 7">Rufino 7</option>
                        <option value="PARADOR DE FUERTEVENTURA">Parador de Fuerteventura</option>
                        <option value="HOTEL ESCUELA PAJARA">Hotel Escuela Pajara</option>
                        <option value="PEREZ DEL TORO 54">Perez del Toro</option>
                        <option value="CHT">CHT</option>
                        <option value="ATALAYA 15">Atalaya 15</option>
                        <option value="PEROJO 16">Perojo 16</option>
                        <option value="AYAGUARES 9">Ayaguares 9</option>
                        <option value="JOAQUIN BLANCO TORRENT">Joaquin Blanco Torrent</option>
                        <option value="JUAN DOMINGUEZ PEÑA">Juan Dominguez Peña</option>
                    </select>
                    <label for="placement" class="color-black"><h6 title="Este campo es obligatorio">Ubicación<span class="text-danger">*</span></h6></label>
                    <input id="placement" class="form-control mb-2" type="text" name="placement" required>
                    <label for="date" class="color-black"><h6 title="Este campo es obligatorio">Fecha<span class="text-danger">*</span></h6></label>
                    <input id="date" class="form-control mb-2" type="date" name="date" required>
                    <label for="cause" class="color-black"><h6 title="Este campo es obligatorio">Motivo<span class="text-danger">*</span></h6></label>
                    <textarea id="cause" class="form-control mb-2 row-4" type="text" name="cause" required></textarea>
                    <label for="observations" class="color-black"><h6 title="Este campo es opcional">Observaciones</h6></label>
                    <textarea id="observations" class="form-control mb-2 row-4" type="text" name="observations"></textarea>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 noScriptDisplayNone toggleGeneric" data-dismiss="modal"><strong>Cancelar</strong></button>
                    <noscript>
                        <a href="{{url()->full()}}"><button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 toggleGeneric" ><strong>Cancelar</strong></button></a>
                    </noscript>
                    <button type="submit" class="btn cpBtn bg-deep-blue text-white border-deep-blue px-4 toggleContent" ><strong>Enviar</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addExternalIncidence" tabindex="-1" role="dialog" aria-labelledby="Modal for adding an incidence" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('createExternalIncidence')}}">
                {{csrf_field()}}
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 text-center color-black"><strong>Añadir incidencia externa</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5">
                    <div class="content-fluid">
                        <div class="row">
                            <div class="col-6">
                                <label for="incidence" class="color-black"><h6 title="Este campo es obligatorio">Incidencia<span class="text-danger">*</span></h6></label>
                                <input id="incidence" class="form-control mb-2" type="text" name="incidence" required>
                            </div>
                            <div class="col-6">
                                <label for="informant" class="color-black"><h6 title="Este campo es obligatorio">Informante<span class="text-danger">*</span></h6></label>
                                <input id="informant" class="form-control mb-2" type="text" name="informant" required>
                            </div>
                            <div class="col-6">
                                <label for="code" class="color-black"><h6 title="Este campo es obligatorio">Fecha de incidencia<span class="text-danger">*</span></h6></label>
                                <input type="date" class="form-control mb-2" id="incidence_date" name="incidence_date" required>
                            </div>
                            <div class="col-6">
                                <label for="location" class="color-black"><h6 title="Este campo es obligatorio">Sede<span class="text-danger">*</span></h6></label>
                                <select class="form-control" name="location" required>
                                    <option value="" disabled selected>Seleccione la sede</option>
                                    <option value="GRAN CANARIA 54">Gran Canaria 54</option>
                                    <option value="GRAN CANARIA 70">Gran Canaria 70</option>
                                    <option value="CISNEROS 82">Cisneros 82</option>
                                    <option value="CISNEROS 105">Cisneros 105</option>
                                    <option value="MAHAN 104">Mahan 104</option>
                                    <option value="BARSINA 12">Barsina 12</option>
                                    <option value="PIZARRO 45">Pizarro 45</option>
                                    <option value="CANELEJAS">Canelejas</option>
                                    <option value="ANTIGUA">Antigua</option>
                                    <option value="FERNANDO GUANARTEME 44">Fernando Guanarteme 44</option>
                                    <option value="PLAZA ALONSO QUESADA">Plaza Alonso Quesada</option>
                                    <option value="RUFINO 7">Rufino 7</option>
                                    <option value="PARADOR DE FUERTEVENTURA">Parador de Fuerteventura</option>
                                    <option value="HOTEL ESCUELA PAJARA">Hotel Escuela Pajara</option>
                                    <option value="PEREZ DEL TORO 54">Perez del Toro</option>
                                    <option value="CHT">CHT</option>
                                    <option value="ATALAYA 15">Atalaya 15</option>
                                    <option value="PEROJO 16">Perojo 16</option>
                                    <option value="AYAGUARES 9">Ayaguares 9</option>
                                    <option value="JOAQUIN BLANCO TORRENT">Joaquin Blanco Torrent</option>
                                    <option value="JUAN DOMINGUEZ PEÑA">Juan Dominguez Peña</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="contact" class="color-black"><h6 title="Este campo es opcional">Contacto</h6></label>
                                <input id="contact" class="form-control mb-2" type="text" name="contact">
                            </div>
                            <div class="col-6">
                                <label for="responsible" class="color-black"><h6 title="Este campo es opcional">Responsable</h6></label>
                                <input id="responsible" class="form-control mb-2" type="text" name="responsible">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 noScriptDisplayNone toggleGeneric" data-dismiss="modal"><strong>Cancelar</strong></button>
                    <noscript>
                        <a href="{{url()->full()}}"><button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 toggleGeneric" ><strong>Cancelar</strong></button></a>
                    </noscript>
                    <button type="submit" class="btn cpBtn bg-deep-blue text-white border-deep-blue px-4 toggleContent" ><strong>Enviar</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="addServiceIncidence" tabindex="-1" role="dialog" aria-labelledby="Modal for adding an incidence" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('createServiceIncidence')}}">
                {{csrf_field()}}
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 text-center color-black"><strong>Añadir incidencia de servicio</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5">
                    <div class="content-fluid">
                        <div class="row">
                            <div class="col-6">
                                <label for="incidence" class="color-black"><h6 title="Este campo es obligatorio">Incidencia<span class="text-danger">*</span></h6></label>
                                <input id="incidence" class="form-control mb-2" type="text" name="incidence" required>
                            </div>
                            <div class="col-6">
                                <label for="informant" class="color-black"><h6 title="Este campo es obligatorio">Informante<span class="text-danger">*</span></h6></label>
                                <input id="informant" class="form-control mb-2" type="text" name="informant" required>
                            </div>
                            <div class="col-6">
                                <label for="code" class="color-black"><h6 title="Este campo es obligatorio">Fecha de incidencia<span class="text-danger">*</span></h6></label>
                                <input type="date" class="form-control mb-2" id="incidence_date" name="incidence_date" required>
                            </div>
                            <div class="col-6">
                                <label for="location" class="color-black"><h6 title="Este campo es obligatorio">Sede<span class="text-danger">*</span></h6></label>
                                <select class="form-control" name="location" required>
                                    <option value="" disabled selected>Seleccione la sede</option>
                                    <option value="GRAN CANARIA 54">Gran Canaria 54</option>
                                    <option value="GRAN CANARIA 70">Gran Canaria 70</option>
                                    <option value="CISNEROS 82">Cisneros 82</option>
                                    <option value="CISNEROS 105">Cisneros 105</option>
                                    <option value="MAHAN 104">Mahan 104</option>
                                    <option value="BARSINA 12">Barsina 12</option>
                                    <option value="PIZARRO 45">Pizarro 45</option>
                                    <option value="CANELEJAS">Canelejas</option>
                                    <option value="ANTIGUA">Antigua</option>
                                    <option value="FERNANDO GUANARTEME 44">Fernando Guanarteme 44</option>
                                    <option value="PLAZA ALONSO QUESADA">Plaza Alonso Quesada</option>
                                    <option value="RUFINO 7">Rufino 7</option>
                                    <option value="PARADOR DE FUERTEVENTURA">Parador de Fuerteventura</option>
                                    <option value="HOTEL ESCUELA PAJARA">Hotel Escuela Pajara</option>
                                    <option value="PEREZ DEL TORO 54">Perez del Toro</option>
                                    <option value="CHT">CHT</option>
                                    <option value="ATALAYA 15">Atalaya 15</option>
                                    <option value="PEROJO 16">Perojo 16</option>
                                    <option value="AYAGUARES 9">Ayaguares 9</option>
                                    <option value="JOAQUIN BLANCO TORRENT">Joaquin Blanco Torrent</option>
                                    <option value="JUAN DOMINGUEZ PEÑA">Juan Dominguez Peña</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="contact" class="color-black"><h6 title="Este campo es opcional">Contacto</h6></label>
                                <input id="contact" class="form-control mb-2" type="text" name="contact">
                            </div>
                            <div class="col-6">
                                <label for="responsible" class="color-black"><h6 title="Este campo es opcional">Responsable</h6></label>
                                <input id="responsible" class="form-control mb-2" type="text" name="responsible">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 noScriptDisplayNone toggleGeneric" data-dismiss="modal"><strong>Cancelar</strong></button>
                    <noscript>
                        <a href="{{url()->full()}}"><button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 toggleGeneric" ><strong>Cancelar</strong></button></a>
                    </noscript>
                    <button type="submit" class="btn cpBtn bg-deep-blue text-white border-deep-blue px-4 toggleContent" ><strong>Enviar</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addFurniture" tabindex="-1" role="dialog" aria-labelledby="Modal for adding an incidence" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('createFurniture')}}">
                {{csrf_field()}}
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 text-center color-black"><strong>Añadir mobiliario</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5">
                    <div class="content-fluid">
                        <div class="row">
                            <div class="col-6">
                                <label for="code" class="color-black"><h6 title="Este campo es obligatorio">Código<span class="text-danger">*</span></h6></label>
                                <input id="code" class="form-control mb-2" type="number" name="code" required>
                            </div>
                            <div class="col-6">
                                <label for="location" class="color-black"><h6 title="Este campo es obligatorio">Sede<span class="text-danger">*</span></h6></label>
                                <select class="form-control" name="location" required>
                                    <option value="" disabled selected>Seleccione la sede</option>
                                    <option value="GRAN CANARIA 54">Gran Canaria 54</option>
                                    <option value="GRAN CANARIA 70">Gran Canaria 70</option>
                                    <option value="CISNEROS 82">Cisneros 82</option>
                                    <option value="CISNEROS 105">Cisneros 105</option>
                                    <option value="MAHAN 104">Mahan 104</option>
                                    <option value="BARSINA 12">Barsina 12</option>
                                    <option value="PIZARRO 45">Pizarro 45</option>
                                    <option value="CANELEJAS">Canelejas</option>
                                    <option value="ANTIGUA">Antigua</option>
                                    <option value="FERNANDO GUANARTEME 44">Fernando Guanarteme 44</option>
                                    <option value="PLAZA ALONSO QUESADA">Plaza Alonso Quesada</option>
                                    <option value="RUFINO 7">Rufino 7</option>
                                    <option value="PARADOR DE FUERTEVENTURA">Parador de Fuerteventura</option>
                                    <option value="HOTEL ESCUELA PAJARA">Hotel Escuela Pajara</option>
                                    <option value="PEREZ DEL TORO 54">Perez del Toro</option>
                                    <option value="CHT">CHT</option>
                                    <option value="ATALAYA 15">Atalaya 15</option>
                                    <option value="PEROJO 16">Perojo 16</option>
                                    <option value="AYAGUARES 9">Ayaguares 9</option>
                                    <option value="JOAQUIN BLANCO TORRENT">Joaquin Blanco Torrent</option>
                                    <option value="JUAN DOMINGUEZ PEÑA">Juan Dominguez Peña</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="description" class="color-black"><h6 title="Este campo es opcional">Descripción</h6></label>
                                <input id="description" class="form-control mb-2" type="text" name="description">
                            </div>
                            <div class="col-6">
                                <label for="amount" class="color-black"><h6 title="Este campo es obligatorio">Cantidad<span class="text-danger">*</span></h6></label>
                                <input id="amount" class="form-control mb-2" type="number" name="amount" required>
                            </div>
                            <div class="col-6">
                                <label for="status" class="color-black"><h6 title="Este campo es obligatorio">Estado<span class="text-danger">*</span></h6></label>
                                <input id="status" class="form-control mb-2" type="text" name="status" required>
                            </div>
                            <div class="col-6">
                                <label for="$observations" class="color-black"><h6 title="Este campo es opcional">Observación</h6></label>
                                <textarea id="observations" class="form-control mb-2 row-4" type="text" name="observations"></textarea>
                            </div>
                            <div class="col-6">
                                <label for="originalPlacement" class="color-black"><h6 title="Este campo es opcional">Ubicación</h6></label>
                                <input id="originalPlacement" class="form-control mb-2" type="text" name="originalPlacement">
                            </div>
                            <div class="col-6">
                                <label for="currentPlacement" class="color-black"><h6 title="Este campo es opcional">Ubicación actual</h6></label>
                                <input id="currentPlacement" class="form-control mb-2" type="text" name="currentPlacement">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 noScriptDisplayNone toggleGeneric" data-dismiss="modal"><strong>Cancelar</strong></button>
                    <noscript>
                        <a href="{{url()->full()}}"><button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 toggleGeneric" ><strong>Cancelar</strong></button></a>
                    </noscript>
                    <button type="submit" class="btn cpBtn bg-deep-blue text-white border-deep-blue px-4 toggleContent" ><strong>Enviar</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addReservedList" tabindex="-1" role="dialog" aria-labelledby="Modal for adding a reserved list" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('createReservedList')}}">
                {{csrf_field()}}
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 text-center color-black"><strong>Añadir preinscripción</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5">
                    <div class="content-fluid">
                        <div class="row">
                            <div class="col-6">
                                <label for="name" class="color-black"><h6 title="Este campo es obligatorio">Nombre<span class="text-danger">*</span></h6></label>
                                <input id="name" class="form-control mb-2" type="text" name="name" required>
                            </div>
                            <div class="col-6">
                                <label for="type" class="color-black"><h6 title="Este campo es obligatorio">Tipo<span class="text-danger">*</span></h6></label>
                                <select class="form-control" name="type" required>
                                    <option value="" disabled selected>Seleccione si es alumno o profesor</option>
                                    <option value="Alumno">Alumno</option>
                                    <option value="Docente">Docente</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="email" class="color-black"><h6 title="Este campo es obligatorio">Email<span class="text-danger">*</span></h6></label>
                                <input id="email" class="form-control mb-2" type="text" name="email" required>
                            </div>
                            <div class="col-6">
                                <label for="phone" class="color-black"><h6 title="Este campo es obligatorio">Teléfono<span class="text-danger">*</span></h6></label>
                                <input id="phone" class="form-control mb-2" type="number" name="phone" required>
                            </div>
                            <div class="col-6">
                                <label for="location" class="color-black"><h6 title="Este campo es obligatorio">Sede<span class="text-danger">*</span></h6></label>
                                <select class="form-control" name="location" required>
                                    <option value="" disabled selected>Seleccione la sede</option>
                                    <option value="GRAN CANARIA 54">Gran Canaria 54</option>
                                    <option value="GRAN CANARIA 70">Gran Canaria 70</option>
                                    <option value="CISNEROS 82">Cisneros 82</option>
                                    <option value="CISNEROS 105">Cisneros 105</option>
                                    <option value="MAHAN 104">Mahan 104</option>
                                    <option value="BARSINA 12">Barsina 12</option>
                                    <option value="PIZARRO 45">Pizarro 45</option>
                                    <option value="CANELEJAS">Canelejas</option>
                                    <option value="ANTIGUA">Antigua</option>
                                    <option value="FERNANDO GUANARTEME 44">Fernando Guanarteme 44</option>
                                    <option value="PLAZA ALONSO QUESADA">Plaza Alonso Quesada</option>
                                    <option value="RUFINO 7">Rufino 7</option>
                                    <option value="PARADOR DE FUERTEVENTURA">Parador de Fuerteventura</option>
                                    <option value="HOTEL ESCUELA PAJARA">Hotel Escuela Pajara</option>
                                    <option value="PEREZ DEL TORO 54">Perez del Toro</option>
                                    <option value="CHT">CHT</option>
                                    <option value="ATALAYA 15">Atalaya 15</option>
                                    <option value="PEROJO 16">Perojo 16</option>
                                    <option value="AYAGUARES 9">Ayaguares 9</option>
                                    <option value="JOAQUIN BLANCO TORRENT">Joaquin Blanco Torrent</option>
                                    <option value="JUAN DOMINGUEZ PEÑA">Juan Dominguez Peña</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="content" class="color-black"><h6 title="Este campo es obligatorio">Contenido<span class="text-danger">*</span></h6></label>
                                <input id="content" class="form-control mb-2" type="text" name="content" required>
                            </div>
                            <div class="col-6">
                                <label for="info" class="color-black"><h6 title="Este campo es opcional">Información</h6></label>
                                <textarea id="info" class="form-control mb-2 row-4" type="text" name="info"></textarea>
                            </div>
                            <div class="col-6">
                                <label for="status" class="color-black"><h6 title="Este campo es obligatorio">Estado<span class="text-danger">*</span></h6></label>
                                <select class="form-control" name="status" required>
                                    <option value="" disabled selected>Seleccione si está tramitado o no</option>
                                    <option value="0">Sin tramitar</option>
                                    <option value="1">Tramitado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 noScriptDisplayNone toggleGeneric" data-dismiss="modal"><strong>Cancelar</strong></button>
                    <noscript>
                        <a href="{{url()->full()}}"><button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 toggleGeneric" ><strong>Cancelar</strong></button></a>
                    </noscript>
                    <button type="submit" class="btn cpBtn bg-deep-blue text-white border-deep-blue px-4 toggleContent" ><strong>Enviar</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addFormativeAction" tabindex="-1" role="dialog" aria-labelledby="Modal for adding a formative action" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('createFormativeAction')}}">
                {{csrf_field()}}
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 text-center color-black"><strong>Añadir acción formativa</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5">
                    <label for="name" class="color-black"><h6 title="Este campo es obligatorio">Nombre<span class="text-danger">*</span></h6></label>
                    <input type="text" class="form-control mb-2" name="name" id="name" required>

                    <label for="type" class="color-black"><h6 title="Este campo es obligatorio">Tipo<span class="text-danger">*</span></h6></label>
                    <input type="text" class="form-control mb-2" name="type" id="type" required>

                    <label for="speciality" class="color-black"><h6 title="Este campo es opcional">Especialidad</h6></label>
                    <input type="text" class="form-control mb-2" name="speciality" id="speciality">

                    <label for="year" class="color-black"><h6 title="Este campo es obligatorio">Año<span class="text-danger">*</span></h6></label>
                    <input type="number" class="form-control mb-2" name="year" id="year" required>

                    <label for="closed" class="color-black"><h6 title="Este campo es obligatorio">Cerrado<span class="text-danger">*</span></h6></label>
                    <select id="closed" name="closed" class="form-control" required>
                        <option value="0">No</option>
                        <option value="1">Si</option>
                    </select>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 noScriptDisplayNone toggleGeneric" data-dismiss="modal"><strong>Cancelar</strong></button>
                    <noscript>
                        <a href="{{url()->full()}}"><button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 toggleGeneric" ><strong>Cancelar</strong></button></a>
                    </noscript>
                    <button type="submit" class="btn cpBtn bg-deep-blue text-white border-deep-blue px-4 toggleContent" ><strong>Enviar</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addCheckIn" tabindex="-1" role="dialog" aria-labelledby="Modal for adding a check in" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('createCheckIn')}}">
                {{csrf_field()}}
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 text-center color-black"><strong>Añadir registro de entrada</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5">
                    <label for="receiver" class="color-black"><h6 title="Este campo es opcional">Receptor</h6></label>
                    <input type="text" class="form-control mb-2" name="receiver" id="receiver">

                    <label for="entry_code" class="color-black"><h6 title="Este campo es opcional">Código de entrada</h6></label>
                    <input type="text" class="form-control mb-2" name="entry_code" id="entry_code">

                    <label for="document" class="color-black"><h6 title="Este campo es opcional">Documento</h6></label>
                    <input type="text" class="form-control mb-2" name="document" id="document">

                    <label for="date" class="color-black"><h6 title="Este campo es opcional">Fecha</h6></label>
                    <input type="date" class="form-control mb-2" name="date" id="date">

                    <label for="destination" class="color-black"><h6 title="Este campo es opcional">Destino</h6></label>
                    <input type="text" class="form-control mb-2" name="destination" id="destination">

                    <label for="sender" class="color-black"><h6 title="Este campo es opcional">Entregado</h6></label>
                    <input type="text" class="form-control mb-2" name="sender" id="sender">
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 noScriptDisplayNone toggleGeneric" data-dismiss="modal"><strong>Cancelar</strong></button>
                    <noscript>
                        <a href="{{url()->full()}}"><button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 toggleGeneric" ><strong>Cancelar</strong></button></a>
                    </noscript>
                    <button type="submit" class="btn cpBtn bg-deep-blue text-white border-deep-blue px-4 toggleContent" ><strong>Enviar</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addCheckOut" tabindex="-1" role="dialog" aria-labelledby="Modal for adding a check in" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('createCheckOut')}}">
                {{csrf_field()}}
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 text-center color-black"><strong>Añadir registro de salida</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5">
                    <label for="exit_code" class="color-black"><h6 title="Este campo es opcional">Código de salida</h6></label>
                    <input type="text" class="form-control mb-2" name="exit_code" id="exit_code">

                    <label for="document" class="color-black"><h6 title="Este campo es opcional">Documento</h6></label>
                    <input type="text" class="form-control mb-2" name="document" id="document">

                    <label for="date" class="color-black"><h6 title="Este campo es opcional">Fecha</h6></label>
                    <input type="date" class="form-control mb-2" name="date" id="date">

                    <label for="destination" class="color-black"><h6 title="Este campo es opcional">Destino</h6></label>
                    <input type="text" class="form-control mb-2" name="destination" id="destination">

                    <label for="sender" class="color-black"><h6 title="Este campo es opcional">Entregado</h6></label>
                    <input type="text" class="form-control mb-2" name="sender" id="sender">
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 noScriptDisplayNone toggleGeneric" data-dismiss="modal"><strong>Cancelar</strong></button>
                    <noscript>
                        <a href="{{url()->full()}}"><button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 toggleGeneric" ><strong>Cancelar</strong></button></a>
                    </noscript>
                    <button type="submit" class="btn cpBtn bg-deep-blue text-white border-deep-blue px-4 toggleContent" ><strong>Enviar</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addStaff" tabindex="-1" role="dialog" aria-labelledby="Modal for adding a staff" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('createStaff')}}">
                {{csrf_field()}}
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 text-center color-black"><strong>Añadir personal</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="name"><h6 title="Este campo es obligatorio">Nombre<span class="text-danger">*</span></h6></label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="address"><h6 title="Este campo es obligatorio">Dirección<span class="text-danger">*</span></h6></label>
                                <input type="text" class="form-control" name="address" id="address" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="city"><h6 title="Este campo es obligatorio">Municipio<span class="text-danger">*</span></h6></label>
                                <input type="text" class="form-control" name="city" id="city" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="nif"><h6 title="Este campo es obligatorio">DNI<span class="text-danger">*</span></h6></label>
                                <input type="text" class="form-control" name="nif" id="nif" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="social_security"><h6 title="Este campo es obligatorio">Sguridad social<span class="text-danger">*</span></h6></label>
                                <input type="text" class="form-control" name="social_security" id="social_security" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="postal_code"><h6 title="Este campo es obligatorio">Código postal<span class="text-danger">*</span></h6></label>
                                <input type="text" class="form-control" name="postal_code" id="postal_code" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="birth_date"><h6 title="Este campo es obligatorio">Fecha de nacimiento<span class="text-danger">*</span></h6></label>
                                <input type="text" class="form-control" name="birth_date" id="birth_date" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="phone"><h6 title="Este campo es obligatorio">Teléfono<span class="text-danger">*</span></h6></label>
                                <input type="text" class="form-control" name="phone" id="phone" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="bank"><h6 title="Este campo es obligatorio">Banco<span class="text-danger">*</span></h6></label>
                                <input type="text" class="form-control" name="bank" id="bank" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="CC"><h6 title="Este campo es obligatorio">CC<span class="text-danger">*</span></h6></label>
                                <input type="text" class="form-control" name="CC" id="CC" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="marital_status"><h6 title="Este campo es obligatorio">Estado civil<span class="text-danger">*</span></h6></label>
                                <input type="text" class="form-control" name="marital_status" id="marital_status" required>
                            </div>
                            <div class="form-group col-6">
                                <label for="children"><h6 title="Este campo es opcional">Número de hijos</h6></label>
                                <input type="number" class="form-control" name="children" id="children">
                            </div>
                            <div class="form-group col-6">
                                <label for="email"><h6 title="Este campo es opcional">Email</h6></label>
                                <input type="text" class="form-control" name="email" id="email">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 noScriptDisplayNone toggleGeneric" data-dismiss="modal"><strong>Cancelar</strong></button>
                    <noscript>
                        <a href="{{url()->full()}}"><button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 toggleGeneric" ><strong>Cancelar</strong></button></a>
                    </noscript>
                    <button type="submit" class="btn cpBtn bg-deep-blue text-white border-deep-blue px-4 toggleContent" ><strong>Enviar</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addContract" tabindex="-1" role="dialog" aria-labelledby="Modal for adding a contract" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form method="post" action="{{url('createContract')}}">
                {{csrf_field()}}
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 text-center color-black"><strong>Añadir contrato</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-5">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="entity"><h6 title="Este campo es obligatorio">Entidad contratante<span class="text-danger">*</span></h6></label>
                                <input type="text" class="form-control" name="entity" id="entity" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="teacher_nif"><h6 title="Este campo es obligatorio">DNI del trabajador<span class="text-danger">*</span></h6></label>
                                <input type="text" class="form-control" name="teacher_nif" id="teacher_nif" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="type"><h6 title="Este campo es obligatorio">Tipo<span class="text-danger">*</span></h6></label>
                                <input type="text" class="form-control" name="type" id="type" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="course_type"><h6 title="Este campo es obligatorio">Tipo del curso<span class="text-danger">*</span></h6></label>
                                <input type="text" class="form-control" name="course_type" id="course_type" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="gross_salary"><h6 title="Este campo es obligatorio">Salario bruto<span class="text-danger">*</span></h6></label>
                                <input type="number" class="form-control" name="gross_salary" id="gross_salary" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="retentions"><h6 title="Este campo es obligatorio">Retenciones<span class="text-danger">*</span></h6></label>
                                <input type="number" class="form-control" name="retentions" id="retentions" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="net_salary"><h6 title="Este campo es obligatorio">Salario neto<span class="text-danger">*</span></h6></label>
                                <input type="number" class="form-control" name="net_salary" id="net_salary" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="formative_planning"><h6 title="Este campo es obligatorio">Plan formativo<span class="text-danger">*</span></h6></label>
                                <input type="text" class="form-control" name="formative_planning" id="formative_planning" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="case_file"><h6 title="Este campo es obligatorio">Número de expediente<span class="text-danger">*</span></h6></label>
                                <input type="text" class="form-control" name="case_file" id="case_file" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="annuity"><h6 title="Este campo es obligatorio">Anualidad<span class="text-danger">*</span></h6></label>
                                <input type="text" class="form-control" name="annuity" id="annuity" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="agreement"><h6 title="Este campo es obligatorio">Convenio<span class="text-danger">*</span></h6></label>
                                <input type="text" class="form-control" name="agreement" id="agreement" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="other_agreements"><h6 title="Este campo es opcional">Otros convenios</h6></label>
                                <input type="text" class="form-control" name="other_agreements" id="other_agreements">
                            </div>
                            <div class="form-group col-4">
                                <label for="sector"><h6 title="Este campo es obligatorio">Sector<span class="text-danger">*</span></h6></label>
                                <input type="text" class="form-control" name="sector" id="sector" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="course"><h6 title="Este campo es obligatorio">Curso<span class="text-danger">*</span></h6></label>
                                <input type="text" class="form-control" name="course" id="course" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="init_date"><h6 title="Este campo es obligatorio">Fecha de inicio<span class="text-danger">*</span></h6></label>
                                <input type="date" class="form-control" name="init_date" id="init_date" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="end_date"><h6 title="Este campo es obligatorio">Fecha de fin<span class="text-danger">*</span></h6></label>
                                <input type="date" class="form-control" name="end_date" id="end_date" required>
                            </div>
                            <div class="form-group col-4">
                                <label for="total_hours"><h6 title="Este campo es opcional">Horas totales</h6></label>
                                <input type="number" class="form-control" name="total_hours" id="total_hours">
                            </div>
                            <div class="form-group col-4">
                                <label for="daily_hours"><h6 title="Este campo es opcional">Horas diarias</h6></label>
                                <input type="number" class="form-control" name="daily_hours" id="daily_hours">
                            </div>
                            <div class="form-group col-4">
                                <label for="schedule"><h6 title="Este campo es opcional">Horario</h6></label>
                                <input type="text" class="form-control" name="schedule" id="schedule">
                            </div>
                            <div class="form-group col-4">
                                <label>Días laborales</label><br>
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="checkbox" id="monday" name="monday">Lunes<br>
                                            <input type="checkbox" id="tuesday" name="tuesday">Martes<br>
                                            <input type="checkbox" id="wednesday" name="wednesday">Miércoles<br>
                                            <input type="checkbox" id="thursday" name="thursday">Jueves<br>
                                        </div>
                                        <div class="col-6">
                                            <input type="checkbox" id="friday" name="friday">Viernes<br>
                                            <input type="checkbox" id="saturday" name="saturday">Sábado<br>
                                            <input type="checkbox" id="sunday" name="sunday">Domingo<br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label for="location"><h6 title="Este campo es opcional">Lugar de impartición</h6></label>
                                <input type="text" class="form-control" name="location" id="location">
                            </div>
                            <div class="form-group col-4">
                                <label for="observations"><h6 title="Este campo es opcional">Observaciones</h6></label>
                                <textarea id="observations" class="form-control mb-2 row-4" type="text" name="observations"></textarea>
                            </div>
                            <div class="form-group col-4">
                                <label for="communication_date"><h6 title="Este campo es opcional">Fecha de comunicación</h6></label>
                                <input type="date" class="form-control" name="communication_date" id="communication_date">
                            </div>
                            <div class="form-group col-4">
                                <label for="processing_date"><h6 title="Este campo es opcional">Fecha de tramitación</h6></label>
                                <input type="date" class="form-control" name="processing_date" id="processing_date">
                            </div>
                            <div class="form-group col-4">
                                <label for="company_code"><h6 title="Este campo es opcional">Código de empresa</h6></label>
                                <input type="number" class="form-control" name="company_code" id="company_code">
                            </div>
                            <div class="form-group col-4">
                                <label for="employee_code"><h6 title="Este campo es opcional">Código de trabajador</h6></label>
                                <input type="number" class="form-control" name="employee_code" id="employee_code">
                            </div>
                            <div class="form-group col-4">
                                <label for="INEM_code"><h6 title="Este campo es opcional">Código de INEM</h6></label>
                                <input type="text" class="form-control" name="INEM_code" id="INEM_code">
                            </div>
                            <div class="form-group col-4">
                                <label for="processed"><h6 title="Este campo es opcional">Tramitado</h6></label>
                                <select id="processed" name="processed" class="form-control">
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 noScriptDisplayNone toggleGeneric" data-dismiss="modal"><strong>Cancelar</strong></button>
                    <noscript>
                        <a href="{{url()->full()}}"><button type="button" class="btn cpBtn color-deep-blue border-deep-blue px-4 toggleGeneric" ><strong>Cancelar</strong></button></a>
                    </noscript>
                    <button type="submit" class="btn cpBtn bg-deep-blue text-white border-deep-blue px-4 toggleContent" ><strong>Enviar</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- N A V B A R -->

<div id="wrapper">

    <!-- Sidebar -->
    <div class="navbar-nav bg-deep-blue sidebar sidebar-dark accordion noPrint" id="accordionSidebar">
        <div class="sticky-sidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
                <img width="100" src="{{asset('images/ftv2000logoResponsive.svg')}}">
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <div class="sidebar-heading">Usuario</div>

            <div class="nav-item">
                <div class="collapse-group">
                    <a class="nav-link collapsed interactive">
                        <i class="glyphicon glyphicon-user"></i>
                        <span>{{$adminData[0]}}</span>
                    </a>
                    <a class="nav-link collapsed pt-0 interactive" href="{{url('closeSession')}}">
                        <i class="fas fa-door-open"></i>
                        <span>Cerrar sesión</span>
                    </a>
                </div>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">Panel de Control</div>
            <!-- Nav Item - Pages Collapse Menu -->
            <?php
                if($adminData[1] != 6 && $adminData[1] <= 5 && $adminData[1] > 0) {
                    echo'
                    <div class="nav-item">
                        <div class="collapse-group">
                            <a class="nav-link '; if(isset($page) && ($page == 'incidences' || $page == 'computers' || $page == 'audits')) echo 'selected'; else echo 'collapsed'; echo'" href="#" data-toggle="collapse" data-target="#navMenu" aria-expanded="true" aria-controls="navMenu">
                                <i class="fa fa-laptop"></i>
                                <span>Equipos</span>
                            </a>
                            <div class="collapse in '; if(isset($page) && ($page == 'incidences' || $page == 'computers' || $page == 'audits')) echo 'show'; echo'" id="navMenu">

                                <div class="collapse-group">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#incidencias" data-parent="#accordionSidebar" aria-expanded="true" aria-controls="incidencias">
                                        <span '; if(isset($page) && $page == 'incidences') echo 'class="selected"'; echo'>Incidencias</span>
                                    </a>
                                    <div class="collapse in"  id="incidencias">
                                        <div class="bg-deep-blue py-2 collapse-inner rounded">
                                            <p class="text-white collapse-item interactive" data-toggle="modal" data-target="#addIncidence">Añadir incidencia</p>';
                                                if($adminData[1] == 1 || $adminData[1] == 4) echo '<a href="'.url('viewUnsolvedTableIncidences').'" class="text-decoration-none"><p class="text-white collapse-item">Incidencias abiertas</p></a>';
                                                if($adminData[1] == 1 || $adminData[1] == 4) echo '<a href="'.url('viewIncidences').'" class="text-decoration-none"><p class="text-white collapse-item">Ver/Modificar incidencias</p></a>';
                                        echo'</div>
                                    </div>';
                                if($adminData[1] == 1 && $adminData[1] > 0){
                                    echo '
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#equipos" data-parent="#accordionSidebar" aria-expanded="true" aria-controls="equipos">
                                        <span '; if(isset($page) && $page == 'computers') echo 'class="selected"'; echo'>Equipos</span>
                                    </a>
                                    <div class="collapse in"  id="equipos">
                                        <div class="bg-deep-blue py-2 collapse-inner rounded">
                                            <p class="text-white collapse-item interactive" data-toggle="modal" data-target="#addComputer">Añadir equipo</p>
                                            <a href="'.url('editPlacementComputers').'" class="text-decoration-none"><p class="text-white collapse-item">Mover equipos</p></a>
                                            <a href="'.url('viewComputers').'" class="text-decoration-none"><p class="text-white collapse-item">Ver/Modificar equipos</p></a>
                                        </div>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#auditorias" data-parent="#accordionSidebar" aria-expanded="true" aria-controls="auditorias">
                                        <span '; if(isset($page) && $page == 'audits') echo 'class="selected"'; echo'>Auditorías</span>
                                    </a>
                                    <div class="collapse in"  id="auditorias">
                                        <div class="bg-deep-blue py-2 collapse-inner rounded">
                                            <p class="text-white collapse-item interactive" data-toggle="modal" data-target="#addAudit">Añadir auditoría</p>
                                            <a href="'.url('viewAudits').'" class="text-decoration-none"><p class="text-white collapse-item">Ver/Modificar auditorías</p></a>
                                        </div>
                                    </div>
                                    ';
                                }

                                echo '</div>
                            </div>
                        </div>
                    </div>';
                }


            if($adminData[1] <= 5 && $adminData[1] > 0) {
                echo'
                    <div class="nav-item">
                        <div class="collapse-group">
                            <a class="nav-link '; if(isset($page) && ($page == 'externalIncidences' || $page == 'serviceIncidences' || $page == 'furniture')) echo 'selected'; else echo 'collapsed'; echo'" href="#" data-toggle="collapse" data-target="#navMenu2" aria-expanded="true" aria-controls="navMenu2">
                                <i class="fas fa-wrench"></i>
                                <span>Mantenimiento</span>
                            </a>
                            <div class="collapse in '; if(isset($page) && ($page == 'externalIncidences' || $page == 'serviceIncidences' || $page == 'furniture')) echo 'show'; echo'" id="navMenu2">

                                <div class="collapse-group">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#externalIncidence" data-parent="#accordionSidebar" aria-expanded="true" aria-controls="externalIncidence">
                                        <span '; if(isset($page) && $page == 'externalIncidences') echo 'class="selected"'; echo'>Incidencias externas</span>
                                    </a>
                                    <div class="collapse in"  id="externalIncidence">
                                        <div class="bg-deep-blue py-2 collapse-inner rounded">
                                            <p class="text-white collapse-item interactive" data-toggle="modal" data-target="#addExternalIncidence">Añadir incidencia</p>';
                                            if($adminData[1] == 1  || $adminData[1] == 4) echo '<a href="'.url('viewUnsolvedExternalIncidences').'" class="text-decoration-none"><p class="text-white collapse-item">Incidencias abiertas</p></a>';
                                            if($adminData[1] == 1  || $adminData[1] == 4) echo '<a href="'.url('viewExternalIncidences').'" class="text-decoration-none"><p class="text-white collapse-item">Ver/Modificar incidencias</p></a>';
                                        echo'</div>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#serviceIncidence" data-parent="#accordionSidebar" aria-expanded="true" aria-controls="serviceIncidence">
                                        <span '; if(isset($page) && $page == 'serviceIncidences') echo 'class="selected"'; echo'>Incidencias de servicio</span>
                                    </a>
                                    <div class="collapse in"  id="serviceIncidence">
                                        <div class="bg-deep-blue py-2 collapse-inner rounded">
                                            <p class="text-white collapse-item interactive" data-toggle="modal" data-target="#addServiceIncidence">Añadir incidencia</p>';
                                            if($adminData[1] == 1  || $adminData[1] == 4) echo '<a href="'.url('viewUnsolvedServiceIncidences').'" class="text-decoration-none"><p class="text-white collapse-item">Incidencias abiertas</p></a>';
                                            if($adminData[1] == 1  || $adminData[1] == 4) echo '<a href="'.url('viewServiceIncidences').'" class="text-decoration-none"><p class="text-white collapse-item">Ver/Modificar incidencias</p></a>';
                                        echo'</div>
                                    </div>';
                                if($adminData[1] <= 4 && $adminData[1] > 0){
                                    echo '
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#furniture" data-parent="#accordionSidebar" aria-expanded="true" aria-controls="furniture">
                                        <span '; if(isset($page) && $page == 'furniture') echo 'class="selected"'; echo'>Mobiliario</span>
                                    </a>
                                    <div class="collapse in"  id="furniture">
                                        <div class="bg-deep-blue py-2 collapse-inner rounded">
                                            <p class="text-white collapse-item interactive" data-toggle="modal" data-target="#addFurniture">Añadir mobiliario</p>
                                            <a href="'.url('viewFurniture').'" class="text-decoration-none"><p class="text-white collapse-item">Ver/Modificar mobiliario</p></a>
                                        </div>
                                    </div>
                                    ';
                                }

                                echo'</div>
                            </div>
                        </div>
                    </div>
                ';
            }

            if($adminData[1] <= 4 && $adminData[1] > 0) {
                echo '
                <div class="nav-item">
                    <div class="collapse-group">
                        <a class="nav-link '; if(isset($page) && ($page == 'reservedList' || $page == 'formativeAction')) echo 'selected'; else echo 'collapsed'; echo'" href="#" data-toggle="collapse" data-target="#navMenu3" aria-expanded="true" aria-controls="navMenu3">
                            <i class="glyphicon glyphicon-list-alt"></i>
                            <span>Lista de reserva</span>
                        </a>
                        <div class="collapse in '; if(isset($page) && ($page == 'reservedList' || $page == 'formativeAction')) echo 'show'; echo'" id="navMenu3">

                            <div class="collapse-group">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#reservedList" data-parent="#accordionSidebar" aria-expanded="true" aria-controls="reservedList">
                                    <span '; if(isset($page) && $page == 'reservedList') echo 'class="selected"'; echo'>Preinscripciones</span>
                                </a>
                                <div class="collapse in"  id="reservedList">
                                    <div class="bg-deep-blue py-2 collapse-inner rounded">
                                        <p class="text-white collapse-item interactive" data-toggle="modal" data-target="#addReservedList">Añadir preinscripción</p>
                                        <a href="'.url('viewLimitedReservedList').'" class="text-decoration-none"><p class="text-white collapse-item">Ver/Modificar preinscripciones</p></a>
                                    </div>
                                </div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#formativeAction" data-parent="#accordionSidebar" aria-expanded="true" aria-controls="formativeAction">
                                    <span '; if(isset($page) && $page == 'formativeAction') echo 'class="selected"'; echo'>Acción Formativa</span>
                                </a>
                                <div class="collapse in"  id="formativeAction">
                                    <div class="bg-deep-blue py-2 collapse-inner rounded">
                                        <p class="text-white collapse-item interactive" data-toggle="modal" data-target="#addFormativeAction">Añadir acción formativa</p>
                                        <a href="'.url('viewFormativeAction').'" class="text-decoration-none"><p class="text-white collapse-item">Ver/Modificar acción formativa</p></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ';
            }

            if($adminData[1] == 1 || $adminData[1] == 3) {
                echo'
                <div class="nav-item">
                    <div class="collapse-group">
                        <a class="nav-link '; if(isset($page) && ($page == 'checkIn' || $page == 'checkOut')) echo 'selected'; else echo 'collapsed'; echo'" href="#" data-toggle="collapse" data-target="#navMenu4" aria-expanded="true" aria-controls="navMenu4">
                            <i class="glyphicon glyphicon-pencil"></i>
                            <span>Registro</span>
                        </a>
                        <div class="collapse in '; if(isset($page) && ($page == 'checkIn' || $page == 'checkOut')) echo 'show'; echo'" id="navMenu4">

                            <div class="collapse-group">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#checkIn" data-parent="#accordionSidebar" aria-expanded="true" aria-controls="checkIn">
                                    <span '; if(isset($page) && $page == 'checkIn') echo 'class="selected"'; echo'>Registro de entrada</span>
                                </a>
                                <div class="collapse in"  id="checkIn">
                                    <div class="bg-deep-blue py-2 collapse-inner rounded">
                                        <p class="text-white collapse-item interactive" data-toggle="modal" data-target="#addCheckIn">Añadir registro de entrada</p>
                                        <a href="'.url('viewCheckIn').'" class="text-decoration-none"><p class="text-white collapse-item">Ver/Modificar reg. de entrada</p></a>
                                    </div>
                                </div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#checkOut" data-parent="#accordionSidebar" aria-expanded="true" aria-controls="checkOut">
                                    <span '; if(isset($page) && $page == 'checkOut') echo 'class="selected"'; echo'>Registro de salida</span>
                                </a>
                                <div class="collapse in"  id="checkOut">
                                    <div class="bg-deep-blue py-2 collapse-inner rounded">
                                        <p class="text-white collapse-item interactive" data-toggle="modal" data-target="#addCheckOut">Añadir registro de salida</p>
                                        <a href="'.url('viewLimitedCheckOut').'" class="text-decoration-none"><p class="text-white collapse-item">Ver/Modificar reg. de salida</p></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ';
            }

            if($adminData[1] <= 3 && $adminData[1] > 0 || $adminData[1] ==6) {
                echo '
                <div class="nav-item">
                    <div class="collapse-group">
                        <a class="nav-link '; if(isset($page) && ($page == 'staff' || $page == 'contract')) echo 'selected'; else echo 'collapsed'; echo'" href="#" data-toggle="collapse" data-target="#navMenu5" aria-expanded="true" aria-controls="navMenu5">
                            <i class="fas fa-users"></i>
                            <span>Dept. de Personal</span>
                        </a>
                        <div class="collapse in '; if(isset($page) && ($page == 'staff' || $page == 'contract')) echo 'show'; echo'" id="navMenu5">

                            <div class="collapse-group">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#staff" data-parent="#accordionSidebar" aria-expanded="true" aria-controls="staff">
                                    <span '; if(isset($page) && $page == 'staff') echo 'class="selected"'; echo'>Personal</span>
                                </a>
                                <div class="collapse in"  id="staff">
                                    <div class="bg-deep-blue py-2 collapse-inner rounded">
                                        <p class="text-white collapse-item interactive" data-toggle="modal" data-target="#addStaff">Añadir personal</p>
                                        <a href="'.url('viewStaff').'" class="text-decoration-none"><p class="text-white collapse-item">Ver/Modificar personal</p></a>
                                    </div>
                                </div>
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#contract" data-parent="#accordionSidebar" aria-expanded="true" aria-controls="contract">
                                    <span '; if(isset($page) && $page == 'contract') echo 'class="selected"'; echo'>Contrato</span>
                                </a>
                                <div class="collapse in"  id="contract">
                                    <div class="bg-deep-blue py-2 collapse-inner rounded">
                                        <p class="text-white collapse-item interactive" data-toggle="modal" data-target="#addContract">Añadir Contrato</p>
                                        <a href="'.url('viewLimitedContracts').'" class="text-decoration-none"><p class="text-white collapse-item">Ver/Modificar Contratos</p></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ';
            }
        ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <div class="sidebar-heading">Contacto</div>

            <div class="nav-item">
                <div class="collapse-group">
                    <a class="nav-link <?php if(isset($page) && ($page == 'chat')) echo 'selected'; ?>" href="{{url('chat')}}">
                        <i class="far fa-comment-alt"></i>
                        <span>Chat</span>
                        <?php

                        $unread = Count(\App\Message::where('receiver', $adminData[0])->where('seen', 0)->get());

                         if($unread > 0) echo '<span title="Sin leer" class="float-right bg-red px-2 rounded-circle"><strong>'.$unread.'</strong></span>'

                        ?>
                    </a>
                </div>
            </div>


        </div>
        <!-- End of Sidebar -->
    </div>


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content" class="mt-4">
            
            @if($errors->any())
                <!-- E R R O R S -->
                    <p class="text-center px-5 pb-2 w-100"><strong>{{$errors->first()}}</strong></p>
                <!-- E N D   E R R O R S -->
            @endif
            
            @if(Session::has('successMessage'))
                <!-- O T H E R   M E S S A G E S   A N D   A L T E R N A T E   B E H A V I O U R S -->
                    <p class="text-center px-5 w-100"><strong class="py-2 d-block">{{Session::get('successMessage')}}</strong></p>
                <!-- E N D   O T H E R   M E S S A G E S   A N D   A L T E R N A T E   B E H A V I O U R S -->
            @endif

            @show
            @yield('content')
            @section('footer')

        </div>
    </div>
    <!-- End of Content Wrapper -->
</div>

<!-- E N D   N A V B A R -->

<script type="text/javascript" src="{{asset('js/utils.js')}}"></script>

</body>
</html>
@show
