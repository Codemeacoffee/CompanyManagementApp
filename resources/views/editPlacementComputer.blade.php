@extends('layout')
@section('header')
@section('content')

<!--<html>-->
<!--    <head>-->
<!--    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">-->
<!--    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">-->
<!--    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">-->
<!--    <script type="text/javascript"  src="{{asset('js/jquery-3.3.1.min.js')}}"></script>-->
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>-->
<!--    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>-->
<!--    <link-->
<!--      rel="stylesheet"-->
<!--      href="https://unpkg.com/swiper/swiper-bundle.min.css"-->
<!--    />-->
<!--</head>-->
<!--<body>-->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12 offset-0">
            <form action="{{url('moveComputer')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="computerId" id="computerId">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="computerCode">Equipo</label>
                            <input type="text" class="form-control" name="responsible" id="computerCode">
                            <div class="form-control" id="suggestions" style="display:none;"></div>
                            <!--<div class="form-control suggestions" style="display:none;"></div>-->
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="currentPlacementComputer">Ubicación actual</label>
                            <input type="text" class="form-control" name="currentPlacement" id="currentPlacementComputer">
                        </div>
                    </div>
                </div>
                <div>
                    <div class="float-right">
                        <a href="{{url('viewComputers')}}"><button class="btn bg-white border-deep-blue mt-4" type="button"><strong class="color-deep-blue">Volver</strong></button></a>
                        <button class="btn bg-deep-blue mt-4" type="submit"><strong class="text-white">Guardar</strong></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
     $('#computerCode').on('click', function(){
        let value = $(this).val();
            $.ajax({
                url : '{{URL::to('autoCompleteComputer')}}',
                method : 'get',
                data:{
                    'code':value
                },
                dataType:'json',
                success: function(data){
                    if(data != "") {
                        $('#suggestions').show();
                        $('#suggestions').html(data);
                        $('#responsible').css("background","#FFF");
                    } else {
                        $('#suggestions').hide();
                    }
                }
            });   
        }
    );
    
    function selectSuggestion(code, currentPlacementComputer, id) {
        $("#computerCode").val(code);
        $("#currentPlacementComputer").val(currentPlacementComputer);
        $("#computerId").val(id);
        $("#suggestions").hide();
    }
</script>
<!--</body>-->
<!--</html>-->
@stop
@section('footer')
