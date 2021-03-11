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
            <div class="container">

                <form class="ml-2 mt-5" method="GET">
                    <label for="date-appointment"></label>
                    <input name="date-appointment" type="date" class="form-control ui-datepicker" id="date-appointment">
                </form>

            </div>

            <p class="col-md-6" id="times"></p>
        </div>
    </div>
</div>

<script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".ui-datepicker").change(function(e){
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
                            $('#times').prepend($('<div>', {
                                text: element.time
                            }));
                        });
                    });
                },
                error: function (){
                    console.log('error');
                }
            });
        });
    });
</script>




@endsection
