@extends('hospital.layouts.app')

@section('content')
    <link href="/user/profile/css/profile.css" rel="stylesheet">
    <div class="container">
        @if($infoMeetForUser->count()===0)
            <h1>Попередніх записів немає</h1>
        @else

        @foreach($infoMeetForUser as $data)

        <div class="col-md-6 info-card">
            <div class="panel-body panel">
                <h2 class="header-card-doc">{{$data->date}} {{$data->times->time}} {{$data->doctor->specials[0]->name}}</h2>
                <p class="name-doc-card">Лікар: <b>{{$data->doctor->name}} {{$data->doctor->last_name}} {{$data->doctor->patronymic}}</b></p>
                <p>Скарга: <b>{{(!$data->complaint)? 'Скарги не записно':$data->complaint}}</b></p>
                <p>Дігноз: <b>{{(!$data->diagnosis)? 'Діагнозу не проставлено':$data->diagnosis}}</b></p>
                <p>Тип запису: <b>{{($data->type)}}</b></p>
                @if($data->conclusion)
                    <a href="{{Storage::url($data->conclusion)}}" download class="btn btn-primary">Висновок <i class="fa fa-download" aria-hidden="true"></i></a>
                @endif
            </div>

        </div>
        @endforeach
        @endif
    </div>


@endsection
