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
                    <div class="container-card col-lg-offset-2 rounded-circle">
                        <div class="card-doc">
                            <img src="https://html5css.ru/howto/img_avatar2.png" alt="Avatar" style="width: 60%;">
                            <div class="container-card-info">
                                <h4><b>{{$doctor->name}} {{$doctor->patronymic}} {{$doctor->last_name}}</b></h4>
                                <p>{{$doctor->email}}</p>
                                <p>Время работы: {{$doctor->email}}</p>

                            </div>
                        </div>
                        <a href="{{route('appointment.index',$doctor->id)}}" class="btn btn-info col-md-offset-9 p-1">Записаться</a>
                    </div>
                @endforeach
            </div>
        </div>

    </div>



@endsection
