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
                            <li class="button appointment-patients"><a href="#"> <i class="fa fa-edit"></i>Пацієнти</a></li>
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
                        <div class="panel-body bio-graph-info">
                            <h1>Особиста інформація</h1>
                            <div class="row">
                                <div class="bio-row">
                                    <p><span><b>Ім"я </b> </span>: {{$userInfo->user->name}}</p>
                                </div>
                                <div class="bio-row">
                                    <p><span><b>Прізвище</b> </span>: {{$userInfo->user->last_name}}</p>
                                </div>
                                <div class="bio-row">
                                    <p><span><b>Адреса</b> </span>: {{$userInfo->city}} {{$userInfo->address}}</p>
                                </div>
                                <div class="bio-row">
                                    <p><span><b>Дата народження</b></span>: {{$userInfo->DOB}}</p>
                                </div>
                                <div class="bio-row">
                                    <p><span><b>Email</b> </span>: {{$userInfo->user->email}}</p>
                                </div>
                                <div class="bio-row">
                                    <p><span><b>Мобільний телефон</b> </span>: {{$userInfo->phone}}</p>
                                </div>
                                <div class="bio-row">
                                    <p><span><b>Вага</b> </span>: {{$userInfo->rise}}</p>
                                </div>
                                <div class="bio-row">
                                    <p><span><b>Зріст</b> </span>: {{$userInfo->weight}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel profile-info col-md-9 edit-information-profile hidden">
                        <div class="panel-body bio-graph-info">
                            <h1>Введіть нові дані</h1>
                            <div class="row">
                                <form>
                                    <div class="bio-row">
                                        <label for="name">Iм"я</label> <input type="text" id="name" class="form-control col-md-3" value="{{$userInfo->user->name}}">
                                    </div>
                                    <div class="bio-row">
                                        <label for="last_name">Прізвище</label> <input type="text" id="last_name" class="form-control col-md-3" value="{{$userInfo->user->last_name}}">
                                    </div>
                                    <div class="bio-row">
                                        <label for="city">Місто</label> <input type="text" id="city" class="form-control col-md-3" value="{{$userInfo->city}}">
                                    </div>
                                    <div class="bio-row">
                                        <label for="DOB">Дата народження</label> <input type="date" id="DOB" class="form-control col-md-3" value="{{$userInfo->DOB}}">
                                    </div>
                                    <div class="bio-row">
                                        <label for="email">Email</label> <input type="text" id="email" class="form-control col-md-3" value="{{$userInfo->user->email}}">
                                    </div>
                                    <div class="bio-row">
                                        <label for="phone">Мобільний телефон</label> <input type="text" id="phone" class="form-control col-md-3" value="{{$userInfo->phone}}">
                                    </div>
                                    <div class="bio-row">
                                        <label for="rise">Зріст</label> <input type="text" id="rise" class="form-control col-md-3" value="{{$userInfo->rise}}">
                                    </div>
                                    <div class="bio-row">
                                        <label for="weight">Вага</label> <input type="text" id="weight" class="form-control col-md-3" value="{{$userInfo->weight}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <a class="btn btn-primary" id="submit-new-info">Submit</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-9 panel profile-info appointment-info">
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
    </div>
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>


    @include('scripts.profile.script-update-info-profile-ajax')
    @include('scripts.profile.script-change-page')
    @include('scripts.profile.script-ajax-time-update')
    @include('scripts.profile.script-photo-update')
@endsection
