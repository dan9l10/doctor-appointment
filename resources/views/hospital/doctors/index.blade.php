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
    <div style="margin: 10px" class="row justify-content-around">
        <div class="row no-gutters mx-4">
            <div class="col-md-4">
                <div class="col-md-offset-6">
                    col-sm-4
                </div>
            </div>
            <div class="col-md-8">
                @foreach($doctorInfo as $doctor)
                    <div class="container-card col-lg-offset-4 rounded-circle">
                        <div class="card-doc">
                            <img src="https://html5css.ru/howto/img_avatar2.png" alt="Avatar" style="width: 40%;">
                            <div class="container-card-info">
                                <h4><b>{{$doctor->name}} {{$doctor->patronymic}} {{$doctor->last_name}}</b></h4>
                                <p>{{$doctor->email}}</p>
                                <p>Время работы: {{$doctor->email}}</p>

                            </div>
                        </div>
                        <a href="{{route('appointment.index',$doctor->id)}}" class="btn btn-info col-md-offset-10">Записаться</a>
                    </div>
                @endforeach
            </div>
        </div>

    </div>



@endsection
