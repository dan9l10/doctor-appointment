@extends('hospital.layouts.app')

@section('content')

    <div class="alert alert-success alert-block" style="display: none;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong class="success-msg"></strong>
    </div>

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
    <div class="row justify-content-md-center">
        <div class="col-md-auto">
            <img class="col-md-3" src="https://html5css.ru/howto/img_avatar2.png" alt="Avatar">
            <p class="col-1"><small>{{$appointments->specials->name}}</small></p>
            <p class="col-md-9">
                <b>
                    {{$appointments->user->name}} {{$appointments->user->last_name}} {{$appointments->user->patronymic}}
                </b>
            </p>
        </div>
    </div>
    <div class="row">
        <form method="POST" action="{{ route('meet.create',$appointments->user->id) }}">
            @method('POST')
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="date-appointment">Выберите дату*</label>
                    <input name="date-appointment" type="date" class="form-control ui-datepicker" id="date-appointment" value="{{date('Y-m-d')}}" min="">
                </div>
                <div class="form-group">
                    <label for="inputLogType" class="col-md-6 control-label">Выберите время*</label>
                    <div>
                        <div class="btn-group" data-toggle="buttons" id="times">

                        </div>
                    </div>
                </div>
                <div class="form-group col-md-11">
                    <label for="complaint ">Опишите свою жалобу (* от 30 символов)</label>
                    <textarea name="complaint" rows="3" class="form-control " id="complaint">{{old('complaint')}}</textarea>
                </div>
            </div>
            <div class="col-md-9">
                <button type="submit" class="btn btn-primary" id="sendDataAppointment">Create</button>
            </div>
        </form>
    </div>

</div>


<script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        refresh();
        $(".ui-datepicker").on('change', function(e){
            refresh();
        });
    });
    function refresh() {
        var date = $(".ui-datepicker").val();
        $.ajax({
            url: "{{route('time.update')}}",
            type: 'GET',
            data: {
                date: date
            },
            dataType: 'json',
            success: function (data) {
                $('#times').empty();
                $.each(data, function (index, element) {
                    $.each(element.times, function (index, element) {
                        if (element.status === 1) {
                            $('#times').append($('<label class="btn btn-primary disabled"><input type="radio" name="time" id="time">' + element.time + '</label>'));
                        } else {
                            $('#times').append($('<label class="btn btn-primary"><input type="radio" name="time" id="time" value="' + element.time + '">' + element.time + '</label>'));
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
