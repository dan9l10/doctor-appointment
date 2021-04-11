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
                        <form method="POST" enctype="multipart/form-data" id="file-upload">
                            @csrf
                            <label for="avatar" style="cursor: pointer;"><i class="fas fa-edit"></i></label>
                            <input type="file" name="avatar" id="avatar" style="opacity: 0;position: absolute;z-index: -1;">
                        </form>
                        <h1>{{$userInfo->user->name}} {{$userInfo->user->last_name}}</h1>
                        <p>{{$userInfo->user->email}}</p>
                    </div>

                    <ul class="nav nav-pills nav-stacked">
                        <li class="button active appointment"><a href="#"> <i class="fa fa-calendar"></i> Візити <span class="label label-warning pull-right r-activity">{{$countMeet}}</span></a></li>
                        <li class="button"><a href=" {{route('doctors.show')}} "> <i class="fa fa-edit"></i> Записатися на візит</a></li>
                        @if(auth()->user()->hasRole('doctor'))
                            <li class="button appointment-patients"><a href="{{route('patient.doctor.index')}}"> <i class="fa fa-edit"></i>Пацієнти</a></li>
                        @endif
                        @if(auth()->user()->hasRole('admin'))
                            <li class="button"><a href="{{route('admin.panel')}}"> <i class="fa fa-edit"></i>Panel</a></li>
                        @endif
                        <li class="button edit-information"><a href="#"> <i class="fa fa-edit"></i> Змінити особисту інформацію</a></li>
                        <li class="button information"><a href="#" > <i class="fa fa-user"></i> Особиста інформація</a></li>
                    </ul>
                </div>
            </div>
                <div class="active-content">

                    <div class="panel profile-info col-md-9 information-profile hidden">

                    </div>

                    <div class="col-md-9 panel profile-info appointment-info">
                        <div class="row">
                            <h3 class="col-md-9">Відвідування: </h3>
                        </div>
                        <div class="row" style="margin-bottom: 5px;">
                            <div class="col-md-6">
                                <select class="form-control" name="" id="">
                                    <option value="">Усі записи</option>
                                    <option value="">Заплановані</option>
                                    <option value="">Завершені</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            @if(empty($meets[0]))
                                <p class="col-md-offset-5">Записів немає</p>
                            @else
                                @foreach($meets as $meet)
                                    <div>
                                        <div class="col-md-12">
                                            <div class="panel" style="background: #fcfaf8;">
                                                <div class="panel-body">
                                                    <div class="col-md-6">
                                                        <a href="{{route('appointment.index',$meet->doctor->id)}}" style="font-size: 15px;"><b>{{$meet->doctor->name}} {{$meet->doctor->patronymic}} {{$meet->doctor->last_name}}</b></a>
                                                        <div class="col-md-12" style="margin-top: 10px;">
                                                            <p>ВАШ ЗАПИС</p>
                                                            <p>Дата: <b>{{$meet->date}}</b></p>
                                                            <p>Статус: <b>{{($meet->status)? "Завершено" : "Заплановано"}}</b></p>
                                                            <p>Час: <b>{{$meet->times->time}}</b></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-offset-8">
                                                        <div class="row">
                                                            <input id="{{$meet->id}}" type="button" class="btn btn-primary info-meet-show" onclick="getDataMeet($(this));return false;" value="Переглянути інформацію"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <script>

        function getDataMeet($this){
            var id = $this.attr('id')
            console.log(id);

            $.ajax({
                url: '/meet/'+id,
                type: 'GET',
                data: {
                   id:id
                },
                dataType: 'json',
                success: function (data) {
                    $('.appointment-info').addClass('hidden');
                    $('.information-profile').removeClass('hidden').empty().append(`
                        <div class="panel-body bio-graph-info">
                            <div class="row">
                                <p class="col-md-6"><b>Дата: </b>${data.date}</p>
                                <p class="col-md-6"><b>Лікар: </b>${data.doctor.name} ${data.doctor.last_name} ${data.doctor.patronymic}</p>
                            </div>
                            <div class="row">
                                <p class="col-md-6"><b>Час: </b>${data.times.time}</p>
                                <p class="col-md-6"><b>Cтатус: </b>${(data.status)? 'Завершено': 'Очікується'}</p>
                            </div>
                        </div>
                        <div class="panel-body bio-graph-info">
                            <div class="row">
                                <p class="col-md-12"><b>Скрага: </b>${data.complaint}</p>
                            </div>
                            <div class="row">
                                <p class="col-md-12"><b>Діагноз: </b>${(data.diagnosis)? data.diagnosis : 'Діагнозу не проставлено'}</p>
                            </div>
                        </div>

                    `);
                    if (data.status){
                        $('.information-profile').append(`<div class="col-md-offset-7"><div class="row"><a onclick="back()" class="btn ml-2">Повернутись назад</a> <a href="" class="btn btn-primary">Записатися повторно</a></div></div>`)
                    }else{
                        $('.information-profile').append(`<div class="col-md-offset-9"><div class="row"><a onclick="back()" class="btn ml-2">Повернутись назад</a></div></div>`)
                    }

                },
                error: function (data) {
                    console.log(data);
                }
            });

        }
        function back(){
            // $('.back-link').on('click',function (){
                $('.information-profile').addClass('hidden');
                $('.appointment-info').removeClass('hidden');
           /* });*/
        }


    </script>


    @include('scripts.profile.script-update-info-profile-ajax')
    @include('scripts.profile.script-change-page')
    @include('scripts.profile.script-ajax-time-update')
    @include('scripts.profile.script-photo-update')
@endsection
