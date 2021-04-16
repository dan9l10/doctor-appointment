@extends('hospital.layouts.app')
@section('content')
    <link href="/user/profile/css/profile.css" rel="stylesheet">
    <div class="container">
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
        <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-auto">
                            <img class="col-md-3" src="{{($appointments->avatar)? $appointments->avatar : 'https://html5css.ru/howto/img_avatar2.png'}}" alt="Avatar">
                            <p class="col-1"><small>{{$appointments->specials->name}}</small></p>
                            <p class="col-md-9">
                                <b>
                                    {{$appointments->user->name}} {{$appointments->user->last_name}} {{$appointments->user->patronymic}}
                                </b>
                            </p>
                        </div>
                    </div>
                </div>
        </div>
        <div class="panel">
            <div class="panel-body profile-info">
                <form method="POST" action="{{ route('meet.create',$appointments->user->id) }}" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="date-appointment">Выберите дату*</label>
                            <input name="date-appointment" type="date" class="form-control ui-datepicker" id="date-appointment" onchange="refresh({{$appointments->id}})">
                        </div>
                        <div class="form-group">
                            <label for="inputLogType" class="col-md-6 control-label">Выберите время*</label>
                            <div class="col-md-6">
                                <div class="btn-group" data-toggle="buttons" id="times">
                                    <p>Выберите дату</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-11">
                            <label for="complaint">Опишите свою жалобу (* от 30 символов)</label>
                            <textarea name="complaint" rows="3" class="form-control " id="complaint">{{old('complaint')}}</textarea>
                        </div>
                        <div class="form-group col-md-11">
                            <label for="complaint">Прикрепить результаты анализов</label>
                            <input name="files[]" type="file" class="form-control ui-datepicker" id="files" multiple>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <button type="submit" class="btn btn-primary" id="sendDataAppointment">Create</button>
                    </div>
                </form>
            </div>
        </div>
            <div class="panel">
                <div class="profile-info">
                    Правила запису
                </div>
            </div>
    </div>

<script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
    <script type="text/javascript">
        function refresh(id) {
            var date = $(".ui-datepicker").val();
            $.ajax({
                url: "{{route('time.update')}}",
                type: 'GET',
                data: {
                    date: date,
                    id: id
                },
                dataType: 'json',
                success: function (data) {
                    $('#times').empty();
                    if (!(Object.keys(data).length == 0)) {
                        $.each(data, function (index, element) {
                            $.each(element.times, function (index, element) {
                                if (element.status === 1) {
                                    $('#times').append($('<label class="btn btn-primary disabled"><input type="radio" name="time" id="time" disabled>' + element.time + '</label>'));
                                } else {
                                    $('#times').append($('<label class="btn btn-primary"><input type="radio" name="time" id="time" value="' + element.id + '">' + element.time + '</label>'));
                                }
                            });
                        });
                    }else {
                        $('#times').append($('<p><b>Времени на запись нет</b></p>'));
                    }
                },
                error: function () {
                    console.log('error');
                }
            });
        }
    </script>
@endsection
