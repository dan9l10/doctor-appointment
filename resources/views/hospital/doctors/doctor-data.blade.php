@foreach($doctorInfo as $doctor)
    <div class="row" >
        <div class="container-card col-md-10 col-md-offset-2">
            <div class="card-doc">
                <img src="{{(is_null($doctor->avatar))?'https://html5css.ru/howto/img_avatar2.png':$doctor->avatar}}" alt="Avatar" id="avatar-doctor-info">
                <div class="container-card-info">
                    <div class="main-info">
                        <h4><b>{{$doctor->user->name}} {{$doctor->user->patronymic}} {{$doctor->user->last_name}}</b></h4>
                        <p>{{$doctor->specials->name}}</p>
                        <p>{{$doctor->user->email}}</p>
                    </div>
                    <div class="additional-info-doc">
                        <p><b>Стаж роботи: </b>{{($doctor->experience)}} років</p>
                        <p><b>Ціна прийому від: </b>{{($doctor->price)? $doctor->price.'грн':'Уточнюйте з лікарем'}}</p>
                    </div>
                    <div class="btn-appointment">
                        @if(!($doctor->id == auth()->user()->id))
                            <a href="{{route('appointment.index',$doctor->id)}}" class="btn btn-info">Записатися</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
<div class="col-md-12">
    <div class="col-md-6">{!! $doctorInfo->links() !!}</div>
</div>

