@extends('hospital.admin.layouts.admin_app')

@section('content')
    <div class="container">
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
        <form class="ml-2" method="post" action="{{route('meets.admin.update',$meets->id)}}">
            @method('PATCH')
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="doctor">Доктор</label>
                    <p class="form-control" id="doctor" >{{$meets->doctor->name}} {{$meets->doctor->last_name}} {{$meets->doctor->patronymic}}</p>
                </div>
                <div class="form-group col-md-6">
                    <label for="patient">Пациент</label>
                    <p class="form-control" id="patient" >{{$meets->patient->name}} {{$meets->patient->last_name}} {{$meets->patient->patronymic}} </p>
                </div>
                <div class="form-group col-md-6">
                    <label for="date">Дата </label>
                    <p class="form-control" id="date" >{{$meets->date}} </p>
                </div>
                <div class="form-group col-md-6">
                    <label for="time_old">Время </label>
                    <p type="time_old" class="form-control" id="time_old">{{$meets->times->time}}</p>
                </div>
            </div>
            <p><b>Данные для изменения записи</b></p>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="date">Новая дата</label>
                    <input name="date" type="date" class="form-control ui-datepicker" id="date" onchange="refresh({{$meets->doctor->id}})" value="{{date('Y-m-d')}}" min="">
                </div>
                <div class="form-group col-md-6">
                    <label for="time">Выберите новое время</label>
                    <div id="times">

                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group col-md-6">
                    <label for="status">Статус (0 - в ожидании, 1 - закончилась)</label>
                    <input name="status" type="text" class="form-control" id="status" placeholder="{{($meets->status)? "Закончилась" : "В ожидании"}}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{url()->previous()}}" class="btn ">Back</a>
        </form>
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
                    id:id
                },
                dataType: 'json',
                success: function (data) {
                    $('#times').empty();
                    $.each(data, function (index, element) {
                        $.each(element.times, function (index, element) {
                            if (element.status === 1) {
                                $('#times').append($('<label class="btn btn-primary disabled"><input type="radio" name="time" id="time" disabled>' + element.time + '</label>'));
                            } else {
                                $('#times').append($('<label class="btn btn-primary"><input type="radio" name="time" id="time" value="' + element.id + '">' + element.time + '</label>'));
                            }

                        });
                    });
                },
                error: function () {
                    console.log('error');
                }
            });
        }
    </script>
@endsection
