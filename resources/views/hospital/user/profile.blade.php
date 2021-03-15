@extends('hospital.layouts.app')

@section('content')
    <link href="/user/profile/css/profile.css" rel="stylesheet">
    <div class="container bootstrap snippets bootdey">
        <div class="row">
            <div class="profile-nav col-md-3">
                <div class="panel">
                    <div class="user-heading round">
                        <a href="#">
                            <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="">
                        </a>
                        <h1>{{$userInfo->name}}</h1>
                        <p>{{$userInfo->email}}</p>
                    </div>

                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="#"> <i class="fa fa-user"></i> Profile</a></li>
                        <li><a href="#"> <i class="fa fa-calendar"></i> Recent Activity <span class="label label-warning pull-right r-activity">9</span></a></li>
                        <li><a href="#"> <i class="fa fa-edit"></i> Edit profile</a></li>
                        <li><a href="{{route('doctors.show')}}"> <i class="fa fa-edit"></i> Appointment</a></li>
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
                    <div class="bio-graph-heading">
                        Aliquam ac magna metus. Nam sed arcu non tellus fringilla fringilla ut vel ispum. Aliquam ac magna metus.
                    </div>
                    <div class="panel-body bio-graph-info">
                        <h1>Bio Graph</h1>
                        <div class="row">
                            <div class="bio-row">
                                <p><span>First Name </span>: {{$userInfo->user->name}}</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Last Name </span>: {{$userInfo->user->last_name}}</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Country </span>: {{$userInfo->city}} {{$userInfo->address}}</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Birthday</span>: {{$userInfo->DOB}}</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Email </span>: {{$userInfo->user->email}}</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Mobile </span>: {{$userInfo->phone}}</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Rise </span>: {{$userInfo->rise}}</p>
                            </div>
                            <div class="bio-row">
                                <p><span>Rise </span>: {{$userInfo->weight}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 panel">
                    <div class="row">
                        @foreach($meets as $meet)
                        <div class="col-md-6 card">
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="bio-chart">
                                        <div style="display:inline;width:100px;height:100px;"><canvas width="100" height="100px"></canvas> <a href="#" style="width: 54px; height: 33px; position: absolute; vertical-align: middle; margin-top: 33px; margin-left: -77px; border: 0px; font-weight: bold; font-style: normal; font-variant: normal; font-stretch: normal; font-size: 20px; line-height: normal; font-family: Arial; text-align: center; color: rgb(224, 107, 125); padding: 0px; -webkit-appearance: none; background: none;">Изменить</a></div>
                                    </div>
                                    <div class="bio-desk">
                                        <h4 class="red">{{$meet->doctor->name}} {{$meet->doctor->patronymic}} {{$meet->doctor->last_name}}</h4>
                                        <p>Дата : {{$meet->date}}</p>
                                        <p>Время : {{$meet->times->time}}</p>
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
@endsection
