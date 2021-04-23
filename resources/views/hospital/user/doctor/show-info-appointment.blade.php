@extends('hospital.layouts.app')

@section('content')
    <link href="/user/profile/css/profile.css" rel="stylesheet">
<div class="container bootstrap snippets">
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
    <div class="panel profile-info">
        <a href="{{route('patient.doctor.index')}}" class="col-md-6"><b><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Повернутись до пацієнтів</b></a>
        <div class="panel-body">
            <h3>Пацієнт:</h3>
            <h4><b>{{$meets->patient->name}}  {{$meets->patient->last_name}} {{$meets->patient->patronymic}}</b></h4>
            <p style="margin-top: 10px;">Час:<b> {{$meets->times->time}}</b></p>
            <p>Дата:<b> {{$meets->date}}</b></p>
            @if($meets->type==='online')
            <a href="{{$meets->link}}" target="_blank">Перейти до конференції <i class="fa fa-video-camera" aria-hidden="true"> </i></a>
            @endif
        </div>
    </div>
    <div class="panel profile-info">
        <div class="panel-body">

            <form action="{{route('patient.doctor.update',$meets->id)}}" method="POST">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="complaint"><b>Скарга</b></label>
                    <input type="text" class="form-control" id="complaint" value="{{$meets->complaint}}" disabled>
                </div>
                <div class="form-group">
                    <label for="diagnosis"><b>Діагноз</b></label>
                    <textarea name="diagnosis" class="form-control" id="diagnosis" rows="3" >{{($meets->diagnosis)?$meets->diagnosis:''}}</textarea>
                </div>
                <div class="form-group">
                    @if($meets->status)
                        <input name="status" class="form-check-input" type="checkbox" id="status-appointment" disabled>
                    @else
                        <input name="status" class="form-check-input" type="checkbox" value="1" id="status-appointment">
                    @endif
                    <label class="form-check-label" for="status-appointment">
                        Завершити зустріч
                    </label>
                </div>
                <button class="btn btn-primary" type="submit">Зберегти</button>
            </form>
            @if(!empty($meets->analyzes))
            <div>
                <span id="show-files" style="cursor: pointer;">Переглянути файли аналізів <i class="fa fa-plus" id="icon-show" aria-hidden="true"> </i></span>
                <div id="files">
                    @foreach($pinnedFiles as $path)
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{Storage::url($path['path'])}}" download><i class="fa {{$extensionsClass[$path['extension']]}}" aria-hidden="true"> </i> {{$path['filename']}}</a>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>

    <script>
        $(document).ready(function (){

            $("#files").hide();
            $("#show-files").on('click',function (){
                $("#files").toggle(500);
            })
        })

    </script>
@endsection
