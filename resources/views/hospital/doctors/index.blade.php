@extends('hospital.layouts.app')
@section('content')
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
        }
    </style>
    <div class="container " style="margin-top: 60px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <div class="col-md-6">
                    col-sm-4
                </div>
            </div>
            <div class="col-md-8">
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
