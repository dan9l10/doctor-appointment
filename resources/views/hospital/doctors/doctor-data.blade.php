@foreach($doctorInfo as $doctor)
    <div class="row" >
        <div class="container-card col-md-10 col-md-offset-2">
            <div class="card-doc">
                <img src="{{(is_null($doctor->avatar))?'https://html5css.ru/howto/img_avatar2.png':$doctor->avatar}}" alt="Avatar" style="width: 65%; margin: 5px">
                <div class="container-card-info">
                    <h4><b>{{$doctor->user->name}} {{$doctor->user->patronymic}} {{$doctor->user->last_name}}</b></h4>
                    <p>{{$doctor->user->email}}</p>
                    <p>{{$doctor->specials->name}}</p>
                    @if(!($doctor->id == auth()->user()->id))
                        <a href="{{route('appointment.index',$doctor->id)}}" class="btn btn-info">Записаться</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach
<div class="col-md-12">
    <div class="col-md-6">{!! $doctorInfo->links() !!}</div>
</div>

