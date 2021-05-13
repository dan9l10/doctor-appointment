@extends('hospital.layouts.app')

@section('content')
    <div class="container">

        @foreach($infoMeetForUser as $data)
        <div class="col-md-12">
            <p>{{$data->date}} {{$data->times->time}} {{$data->doctor->specials[0]->name}}</p>
            <p>{{$data->doctor->name}} {{$data->doctor->last_name}} {{$data->doctor->patronymic}}</p>
            <p>Скарга: {{($data->complaint)? 'Скарги не записно':$data->complaint}}</p>
            <p>Дігноз: {{($data->diagnosis)? 'Діагнозу не проставлено':$data->diagnosis}}</p>
            <p>Тип запису: {{($data->type)}}</p>
            @if($data->conclusion)
                <a  href="{{Storage::url($data->conclusion)}}" download>Висновок <i class="fa fa-download" aria-hidden="true"></i></a>
            @endif
        </div>
        @endforeach
    </div>


@endsection
