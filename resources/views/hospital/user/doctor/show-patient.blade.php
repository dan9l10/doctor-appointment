@extends('hospital.layouts.app')
@section('content')

<div class="container bootstrap snippets bootdey">
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
    <a href="{{url()->previous()}}" class="btn btn-danger">Back</a>
    <div class="row">
        <div class="panel profile-info">
            <div class="panel-body">
                <table class="table table-striped ">
                    <thead class="thead-light" >
                    <tr>
                        <th scope="col">
                            <input type="checkbox"
                                   onclick="for(c in document.getElementsByName('meet-id[]')) document.getElementsByName('meet-id[]').item(c).checked=this.checked;">
                        </th>
                        <th scope="col">Дата</th>
                        <th scope="col">Час</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Пацієнт</th>
                        <th scope="col">Тип зустрічі</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($meets as $meet)
                        <tr>
                            <td><input type="checkbox" name="meet-id[]" value="{{$meet->id}}"></td>
                            <td >{{$meet->date}}</td>
                            <td >{{$meet->times->time}}</td>
                            <td>{{ !($meet->status)? "Очікується" : "Закінчена"}}</td>
                            <td>{{$meet->patient->name}} {{$meet->patient->last_name}}</td>
                            <td>{{($meet->type==='online')? 'Відео зв\'язок' : 'Зустріч з лікарем'}}</td>
                            <td><a class="btn btn-primary mr-2" href="{{route('patient.doctor.show',$meet->id)}}" role="button">Інформація</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
