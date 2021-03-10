@extends('hospital.layouts.app')

@section('content')

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
            @foreach($appointments->times as $time)
                <p class="col-md-6">{{$time->time}} </p>
            @endforeach
        </div>
    </div>
</div>






    </script>




@endsection
