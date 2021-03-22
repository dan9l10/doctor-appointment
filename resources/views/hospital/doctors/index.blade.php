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
                        col-sm-4
                    </div>
                </div>
            </div>
            <div class="col-md-8" >
                    @foreach($doctorInfo as $doctor)
                    <div class="row">
                        <div class="container-card col-md-10 col-md-offset-2">
                            <div class="card-doc">
                                <img src="https://html5css.ru/howto/img_avatar2.png" alt="Avatar" style="width: 65%; margin: 5px">
                                <div class="container-card-info">
                                    <h4><b>{{$doctor->name}} {{$doctor->patronymic}} {{$doctor->last_name}}</b></h4>
                                    <p>{{$doctor->email}}</p>
                                    <p>Время работы: {{$doctor->email}}</p>
                                    <a href="{{route('appointment.index',$doctor->id)}}" class="btn btn-info">Записаться</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>
        </div>
    </div>

@endsection
