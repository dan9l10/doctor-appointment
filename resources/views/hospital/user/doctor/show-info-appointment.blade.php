@extends('hospital.layouts.app')

@section('content')
    <link href="/user/profile/css/profile.css" rel="stylesheet">
<div class="container bootstrap snippets">
    @if ($message = Session::get('success'))
        <div class="alert alert-success col-md-12">
            <p>{{$message}}</p>
        </div>
    @elseif($errors->any())
        <div class="alert alert-danger col-md-12">
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
            <div class="col-md-7">
                <h3>Пацієнт:</h3>
                <h4><b>{{$meets->patient->name}}  {{$meets->patient->last_name}} {{$meets->patient->patronymic}}</b></h4>
                <p>Дата народження:<b> {{$meets->userAsMember->DOB}}</b></p>
                <p>Зріст: <b>{{$meets->userAsMember->rise}} см</b> Вага: <b> {{$meets->userAsMember->weight}} кг</b></p>
                <p style="margin-top: 10px;">Час:<b> {{$meets->times->time}}</b></p>
                <p>Дата:<b> {{$meets->date}}</b></p>
                @if($meets->type==='online')
                    <a href="{{$meets->link}}" target="_blank">Перейти до конференції <i class="fa fa-video-camera" aria-hidden="true"> </i></a>
                @endif
            </div>
            <div class="col-md-5">
                <img style="width: 300px;height: 300px;" src="{{($meets->userAsMember->avatar)? $meets->userAsMember->avatar:'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/Circle-icons-profile.svg/1200px-Circle-icons-profile.svg.png' }}" alt="d">
            </div>

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
                @if(!($meets->conclusion))
                    <div class="form-group">
                        @if($meets->status)
                            <input name="conclusion" class="form-check-input" type="checkbox" id="generate-conclusion" disabled>
                        @else
                            <input name="conclusion" class="form-check-input" type="checkbox" value="1" id="generate-conclusion">
                        @endif
                        <label class="form-check-label" for="generate-conclusion">
                            Згенерувати висновок лікаря
                        </label>
                    </div>
                    <div class="form-group" id="data-conclusion">
                        <label for="additional-info-complaint">Додаткова інформація щодо скарги пацієнта</label>
                        <input type="text" id="additional-info-complaint" name="additional-info-complaint" class="form-control">
                        <label for="recommendation"><b>Рекомедації</b></label>
                        <textarea name="recommendation" class="form-control" id="recommendation" rows="3" ></textarea>
                        <label for="pills">Лікарняні препарати</label>
                        <span id="add-field-pills" style="cursor: pointer; color: #000b16;">Додати препарат <i class="fa fa-plus" id="icon-show" aria-hidden="true"> </i></span>
                        <input type="text" id="pills" name="pills[]" class="form-control">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Зберегти</button>
                    </div>
                @else
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Зберегти</button>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <a  href="{{Storage::url($meets->conclusion)}}" download>Висновок <i class="fa fa-download" aria-hidden="true"></i></a>
                        </div>
                    </div>
                @endif
            </form>
            @if(!empty($pinnedFiles) && is_array($pinnedFiles))
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

            $('#data-conclusion').hide();

            $('#generate-conclusion').on('click',function (){
                $("#data-conclusion").toggle(500);
            });

            $('#add-field-pills').on('click',function (){
                $('#data-conclusion').append(`<input type="text" id="pills" name="pills[]" class="form-control">`);
            });

            $("#files").hide();
            $("#show-files").on('click',function (){
                $("#files").toggle(500);
            });
        })

    </script>
@endsection
