@extends('hospital.layouts.app')
@section('content')
    <link href="/user/profile/css/profile.css" rel="stylesheet">
    <style>
        .card-doc {
            width: 75%;
            display: flex;
        }

        .container-card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        .container-card-info {
            padding: 2px 16px;

        }
        .container-card{
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            align-content: end;
            background: #fff;
            margin-bottom: 15px ;
            border-radius: 7px;
        }
        .find-panel{
           padding-top: 10px;
        }
        .main-container-style{
            margin-top: 10px;
        }
    </style>
    <div class="row">
        <div class="col-md-12 find-panel panel">
            <form>
                <div class="form-group col-md-2 col-md-offset-2">
                    <select class="form-control">
                        <option>Value</option>
                        <option>Value</option>
                    </select>
                </div>
                <div class="form-group col-md-6 ">
                    <input name="last_name" type="text" class="form-control" id="last_name" placeholder="Input name">
                </div>
            </form>
        </div>
    </div>
    <div class="container main-container-style" >
        <div class="row no-gutters">
            <div class="col-md-4" >
                <div class="row">
                    <div class="col-md-12 panel">
                        <h3 style="margin-bottom: 5px;">Фільтри за категорією: </h3>
                        @foreach($specials as $special)
                        <div class="form-check">
                            <input class="form-check-input special_checkbox" type="checkbox" attr-name="{{$special->name}}" name="special[]" value="{{$special->id}}" id="{{$special->id}}">
                            <label class="form-check-label" for="{{$special->id}}">
                               {{$special->name}}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div id="filters" class="col-md-12 panel">

                    </div>
                </div>

            </div>


            <div class="col-md-8" id="doc_card">
                    @foreach($doctorInfo as $doctor)
                    <div class="row" >
                        <div class="container-card col-md-10 col-md-offset-2">
                            <div class="card-doc">
                                <img src="{{(is_null($doctor->members->avatar))?'https://html5css.ru/howto/img_avatar2.png':$doctor->members->avatar}}" alt="Avatar" style="width: 65%; margin: 5px">
                                <div class="container-card-info">
                                    <h4><b>{{$doctor->name}} {{$doctor->patronymic}} {{$doctor->last_name}}</b></h4>
                                    <p>{{$doctor->email}}</p>
                                    @foreach($doctor->specials as $special)<p>{{$special->name}}</p>@endforeach
                                    <a href="{{route('appointment.index',$doctor->id)}}" class="btn btn-info">Записаться</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>
        </div>
    </div>
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {


        // Listen for 'change' event, so this triggers when the user clicks on the checkboxes labels

        $('.special_checkbox').on('change', function (e) {
            var specials = [];
            e.preventDefault();
            $('input[name="special[]"]:checked').each(function () {
                specials.push($(this).val());
            });
            console.log(specials);
            send(specials);
        });


        /*$('.special_checkbox').on('change', function (e) {
            specials.push($(this).val());
            console.log(specials);
            send(specials);
        });*/


       /* $('.special_checkbox').on('change', function (e) {
            e.preventDefault();
            if ($(this).is(":checked")) {
                specials.push($(this).val());
                console.log(specials);
            }
            send(specials);
        });*/
    });
    function send(specials){
        $('#doc_card').empty();
        $.ajax({
            url: "{{route('doctor.update')}}",
            type: 'GET',
            data: {
                specials: specials,
            },
            dataType: 'json',
            success: function (responce) {
                if(isNaN(responce)){
                    $('#doc_card').empty();
                    $.each(responce, function (index, element) {
                        $('#doc_card').append(`
                            <div class="container-card col-md-10 col-md-offset-2">
                                <div class="card-doc">
                                    <img src="${(element.avatar)? element.avatar: 'https://html5css.ru/howto/img_avatar2.png' }" alt="Avatar" style="width: 65%; margin: 5px">
                                    <div class="container-card-info">
                                        <h4><b>${element.user.name} ${element.user.last_name} ${element.user.patronymic}</b></h4>
                                        <p>${element.user.email}</p>
                                        <p>${element.specials.name}</p>
                                        <a href="" class="btn btn-info">Записаться</a>
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                }
            },
            error: function () {
                console.log('error');
            }
        });
    }

</script>
@endsection
