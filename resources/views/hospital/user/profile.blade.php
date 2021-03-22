@extends('hospital.layouts.app')

@section('content')

    <link href="/user/profile/css/profile.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <div class="container bootstrap snippets bootdey">
        @if ($message = Session::get('success'))
            <div class="alert alert-success col-md-12 row">
                <p>{{$message}}</p>
            </div>
        @elseif($errors->any())
            <div class="alert alert-danger col-md-12 row">
                <strong>Error!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="profile-nav col-md-3">
                <div class="panel">
                    <div class="user-heading round">


                        <a href="#">
                            <img src="{{empty($userInfo->avatar)? "https://bootdey.com/img/Content/avatar/avatar3.png" : $userInfo->avatar}}" alt="">
                        </a>
                        <h1>{{$userInfo->name}}</h1>
                        <p>{{$userInfo->email}}</p>
                        <form method="POST" enctype="multipart/form-data" id="file-upload">
                            @csrf
                            <label for="avatar" style="cursor: pointer;"><i class="fas fa-edit"></i></label>
                            <input type="file" name="avatar" id="avatar" style="opacity: 0;position: absolute;z-index: -1;">
                        </form>
                    </div>

                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="#"> <i class="fa fa-user"></i> Особиста інформація</a></li>
                        <li><a href="#"> <i class="fa fa-calendar"></i> Візити <span class="label label-warning pull-right r-activity">9</span></a></li>
                        <li><a href="#"> <i class="fa fa-edit"></i> Edit profile</a></li>
                        <li><a href=" {{route('doctors.show')}} "> <i class="fa fa-edit"></i> Записатися на візит</a></li>
                        @if(auth()->user()->hasRole('doctor'))
                            <li><a href=""> <i class="fa fa-edit"></i>Приём пациентов</a></li>
                        @endif
                        @if(auth()->user()->hasRole('admin'))
                            <li><a href="{{route('admin.panel')}}"> <i class="fa fa-edit"></i>Panel</a></li>
                        @endif
                    </ul>
                </div>
            </div>

                <div class="panel profile-info col-md-9">
                    <div class="panel-body bio-graph-info">
                        <h1>Особиста інформація</h1>
                        <div class="row">
                            <div class="bio-row">
                                <p><span>Ім"я </span>: {{$userInfo->user->name}}</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Прізвище </span>: {{$userInfo->user->last_name}}</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Країна </span>: {{$userInfo->city}} {{$userInfo->address}}</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Дата народження</span>: {{$userInfo->DOB}}</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Email </span>: {{$userInfo->user->email}}</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Мобільний телефон </span>: {{$userInfo->phone}}</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Вага </span>: {{$userInfo->rise}}</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Зріст </span>: {{$userInfo->weight}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 panel">
                    <div class="row">
                        <h3 class="col-md-9">Відвідування: </h3>
                    </div>
                    <div class="row">
                        @if(empty($meets[0]))
                            <p class="col-md-offset-5">Записів немає</p>
                        @endif
                        @foreach($meets as $meet)
                        <div class="col-md-12 card">
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="bio-chart">
                                        <div style="display:inline;width:100px;height:100px;">
                                            <canvas width="100" height="100px"></canvas>
                                            <a onclick="refresh({{$meet->doctor->id}})" href="" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" style="width: 54px; height: 33px; position: absolute; vertical-align: middle; margin-top: 33px; margin-left: -77px; border: 0px; font-weight: bold; font-style: normal; font-variant: normal; font-stretch: normal; font-size: 20px; line-height: normal; font-family: Arial; text-align: center; color: rgb(224, 107, 125); padding: 0px; -webkit-appearance: none; background: none;">
                                                Изменить
                                            </a>
                                        </div>
                                    </div>
                                    <div class="bio-desk">
                                        <h4 class="red" onclick="send({{$meet->id}})">{{$meet->doctor->name}} {{$meet->doctor->patronymic}} {{$meet->doctor->last_name}}</h4>
                                        <p>Дата : {{$meet->date}}</p>
                                        <p>Время : {{$meet->times->time}}</p>
                                        <p>Cтатус : {{($meet->status)? "Завершено" : "Заплановано"}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        function refresh(id) {
            var date = $("#date-picker").val();
            $.ajax({
                url: "{{route('time.update')}}",
                type: 'GET',
                data: {
                    date: date,
                    id: id
                },
                dataType: 'json',
                success: function (data) {
                    $('#times').empty();
                    $.each(data, function (index, element) {
                        $.each(element.times, function (index, element) {
                            if (element.status === 1) {
                                $('#times').append($('<label class="btn btn-primary disabled"><input type="radio" name="time" id="time" disabled>' + element.time + '</label>'));
                            } else {
                                $('#times').append($('<label class="btn btn-primary"><input type="radio" name="time" id="time" value="' + element.id + '">' + element.time + '</label>'));
                            }

                        });
                    });
                },
                error: function () {
                    console.log('error');
                }
            });
        }

        function send(idMeet){

            console.log(idMeet);
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function (e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#file-upload').change(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type:'POST',
                    url: "{{ route('avatar.user.upload')}}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        this.reset();
                        alert('File has been uploaded successfully');
                        console.log(data);
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endsection
