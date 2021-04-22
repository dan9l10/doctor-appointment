@foreach($meets as $meet)
    <div>
        <div class="col-md-12">
            <div class="panel meet-info">
                <div class="panel-body">
                    <div class="col-md-6">
                        <a href="{{route('appointment.index',$meet->doctor->id)}}" class="doctor-meet-name"><b>{{$meet->doctor->name}} {{$meet->doctor->patronymic}} {{$meet->doctor->last_name}}</b></a>
                        <div class="col-md-12 meet-info-body">
                            <p>ВАШ ЗАПИС</p>
                            <p>Тип запису: <b>{{($meet->type==='online')? 'Відео зв\'язок' : 'Зустріч з лікарем'}}</b></p>
                            <p>Дата: <b>{{$meet->date}}</b></p>
                            <p>Статус: <b>{{($meet->status)? "Завершено" : "Заплановано"}}</b></p>
                            <p>Час: <b>{{$meet->times->time}}</b></p>
                        </div>
                    </div>
                    <div class="col-md-offset-8">
                        <div class="row">
                            <input id="{{$meet->id}}" type="button" class="btn btn-primary info-meet-show" onclick="getDataMeet($(this));return false;" value="Переглянути інформацію"/>
                            @if($meet->type==='online')
                                <div class="col-md-12">
                                    <a href="{{$meet->link}}" target="_blank">Перейти до конференції <i class="fa fa-video-camera" aria-hidden="true"> </i></a>
                                </div>
                            @else
                                <div class="col-md-12">
                                    <a href="{{ Storage::url($meet->ticket)}}" download>Завантажити квиток <i class="fa fa-download" aria-hidden="true"></i></a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
<div class="col-md-12">
    {{$meets->links()}}
</div>
