@foreach($meets as $meet)
    <tr>
        <td >{{$meet->date}}</td>
        <td >{{$meet->times->time}}</td>
        <td><b>{{ !($meet->status)? "Очікується" : "Закінчена"}}</b></td>
        <td>{{$meet->patient->name}} {{$meet->patient->last_name}}</td>
        <td>{{($meet->type==='online')? 'Відео зв\'язок' : 'Зустріч з лікарем'}}</td>
        <td><a class="btn btn-primary mr-2" href="{{route('patient.doctor.show',$meet->id)}}" role="button" target="_blank">Інформація</a></td>
        <td><a class="btn btn-primary mr-2" href="{{route('info.patient.doctor',$meet->patient->id)}}" role="button" target="_blank">Прийоми</a></td>
        @if($meet->conclusion)
            <td><a href="{{Storage::url($meet->conclusion)}}" download>Висновок <i class="fa fa-download" aria-hidden="true"></i></a></td>
        @endif
    </tr>
@endforeach
{{$meets->links()}}
