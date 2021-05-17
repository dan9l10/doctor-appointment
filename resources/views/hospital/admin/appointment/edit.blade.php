@extends('hospital.admin.layouts.admin_app')


@section('content')
    <script src="/js/vanilla-calendar-min.js"></script>
    <link rel="stylesheet" href="/css/vanilla-calendar-min.css">

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
    <div class="container">
<form action="{{route('admin.appointment.update')}}" method="post">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-header">
            Оберіть лікаря
        </div>
        <div class="card-body">
            <select class="form-control select-doctor" name="doctor">
                <option value="">Оберіть лікаря</option>
                @foreach($doctors as $doctor)
                <option value="{{$doctor->id}}">{{$doctor->name}} {{$doctor->last_name}} {{$doctor->patronymic}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="card calendar hidden">
        <div class="card-header">
            Оберіть дату
        </div>
        <div class="card-body">
            <div id="myCalendar" class="vanilla-calendar" style="margin-bottom: 20px"></div>
            <input type="date" class="form-control" name="date" id="date-appointment" value="" hidden>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Виберіть час для додавання
            <span style="margin-left: 700px">Check/Uncheck
               <input type="checkbox" onclick=" for(c in document.getElementsByName('time[]')) document.getElementsByName('time[]').item(c).checked=this.checked" >
           </span>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tbody class="table-with-times">

                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <button type="submit" class="btn btn-primary">Додати</button>
        </div>
    </div>
</form>
        <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>

    <script>
        let availableDates = [], availableWeekDays = false, calendar = true;

        $(document).ready(function (){
            $('.select-doctor').on('change',function () {
                var idDoc = $('.select-doctor').val();
                $('.calendar').removeClass('hidden');
                $.ajax({
                    url: "/date/get",
                    type: 'GET',
                    data: {
                        id_doc: idDoc,
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
        });

        function createCalendar(availableDates){
            var idDoc = $('.select-doctor').val();
            calendar = new VanillaCalendar({
                selector: "#myCalendar",
                months: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
                shortWeekday: ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
                onSelect: (data, elem) => {
                    refresh(idDoc,data.data);
                    $('#date-appointment').val(data.data.date);
                },
                pastDates:false,
                availableDates: availableDates,
                datesFilter: true
            })
        }

        function refresh(id,date) {
            $('#date-appointment').val(date);
            $.ajax({
                url: "{{route('admin.update.time')}}",
                type: 'GET',
                data: {
                    date: date,
                    idDoc: id
                },
                dataType: 'json',
                success: function (data) {
                    $.each(data,function (id,elem){
                        $('.table-with-times').append($('<tr><td><input type="checkbox" name="time[]"  value="'+elem+'">'+elem+'</td><tr>'))
                    })
                },
                error: function () {
                    console.log('error');
                }
            });
        }
    </script>
@endsection
