@foreach($meets as $meet)
    <tr>
        <td >{{$meet->date}}</td>
        <td >{{$meet->times->time}}</td>
        <td><b>{{ !($meet->status)? "Очікується" : "Закінчена"}}</b></td>
        <td>{{$meet->patient->name}} {{$meet->patient->last_name}}</td>
        <td>{{($meet->type==='online')? 'Відео зв\'язок' : 'Зустріч з лікарем'}}</td>
        <td><a class="btn btn-primary mr-2" href="{{route('patient.doctor.show',$meet->id)}}" role="button">Інформація</a></td>
    </tr>
@endforeach
