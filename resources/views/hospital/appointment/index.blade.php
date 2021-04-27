@extends('hospital.layouts.app')
@section('content')
    <link href="/user/profile/css/profile.css" rel="stylesheet">
    <script src="/js/vanilla-calendar-min.js"></script>

    <link rel="stylesheet" href="/css/vanilla-calendar-min.css">
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
                            <label for="myCalendar">Оберіть дату*</label>
                            <input type="text" name="date-appointment" id="date-appointment" hidden value="">
                            <div id="myCalendar" class="vanilla-calendar" style="margin-bottom: 20px" onchange="refresh({{$appointments->id}})"></div>
                        </div>
                        <div class="form-group">
                            <label for="inputLogType" class="col-md-6 control-label">Оберіть час запису*</label>
                            <div class="col-md-6">
                                <div class="btn-group" data-toggle="buttons" id="times">
                                    <p>Спочатку оберіть дату</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-11">
                            <label for="complaint">Опишіть свою скаргу</label>
                            <textarea name="complaint" rows="3" class="form-control " id="complaint">{{old('complaint')}}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="complaint">Додайте результати аналізів</label>
                            <input name="files[]" type="file" class="form-control ui-datepicker" id="files" multiple>
                        </div>
                        <div class="form-group">
                            <label for="inputLogType" class="col-md-6 control-label">Оберіть тип запису</label>
                            <div class="col-md-6">
                                <div class="btn-group" data-toggle="buttons" id="types-meet">
                                    <label for="type-meet-online" class="btn btn-primary ">Онлайн<input type="radio" name="type-meet" id="type-meet-online" value="online"></label>
                                    <label for="type-meet-offline" class="btn btn-primary active">Офлайн<input type="radio" name="type-meet" id="type-meet-offline" value="offline" checked></label>
                                </div>
                            </div>
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

    <script>
        let availableDates = [], availableWeekDays = false, calendar = true;

        $(document).ready(function (){
            $.ajax({
                url: "/date/get",
                type: 'GET',
                data: {
                    id_doc: {{$appointments->user->id}}
                },
                dataType: 'json',
                success: function (data) {
                    availableDates = data;
                    createCalendar(data);
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });

        function createCalendar(availableDates){
            calendar = new VanillaCalendar({
                selector: "#myCalendar",
                months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
                shortWeekday: ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
                onSelect: (data, elem) => {
                    refresh({{$appointments->id}},data.data);
                    $('#date-appointment').val(data.data.date);
                },
                pastDates:false,
                availableDates: availableDates,
                datesFilter: true
            })
        }

        function refresh(id,date) {
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
