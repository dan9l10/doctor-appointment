@extends('hospital.layouts.app')

@section('content')
    <div class="alert alert-success alert-block" style="display: none;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong class="success-msg"></strong>
    </div>
<div class="container">
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
        <form method="#" action="">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="date-appointment"> Выберите дату</label>
                    <input name="date-appointment" type="date" class="form-control ui-datepicker" id="date-appointment" value="Выберите дату">
                </div>
                <div class="form-group col-md-6">
                    <label for="times">Выберите время</label>
                    <div id="times">        </div>
                </div>
            </div>
            {{----}}
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDisabled" id="flexRadioDisabled" disabled>
                <label class="form-check-label" for="flexRadioDisabled">
                    Disabled radio
                </label>
            </div>

            {{----}}

            <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked>
            <label class="btn btn-secondary" for="option1">Checked</label>

            <input type="radio" class="btn-check" name="options" id="option2" autocomplete="off">
            <label class="btn btn-secondary" for="option2">Radio</label>

            <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off" disabled>
            <label class="btn btn-secondary" for="option3">Disabled</label>

            <input type="radio" class="btn-check" name="options" id="option4" autocomplete="off">
            <label class="btn btn-secondary" for="option4">Radio</label>
            {{----}}

            <div class=" col-md-9">
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
        $(".ui-datepicker").on('change', function(e){
            var date = $(this).val();
            console.log(date);
            $.ajax({
                url:"{{route('time.update')}}",
                type:'GET',
                data: {
                    date:date
                },
                dataType: 'json',
                success: function(data) {
                    $('#times').empty();
                    $.each(data, function(index, element) {
                        $.each(element.times,function (index,element){
                            if (element.status === 1){
                                $('#times').append($('<a class="btn btn-danger disabled">'+element.time+'</a>', {
                                    text: element.time,
                                }));
                            }else {
                                $('#times').append($('<a class="btn btn-primary">'+element.time+'</a>', {
                                    text: element.time,
                                }));
                            }

                        });
                    });
                },
                error: function (){
                    console.log('error');
                }
            });
        });
        $("#sendDataAppointment").on('click', function(e){
            var date = $("date-appointment").val();
            var id_patient = {{auth()->user()->id}};

            console.log(id_patient);
        });

    });
</script>




@endsection
