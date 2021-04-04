@extends('hospital.layouts.app')
@section('content')

<div class="container bootstrap snippets bootdey">
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
                            <td><a class="btn btn-primary mr-2" href="{{route('meets.admin.edit',$meet->id)}}" role="button">Информация</a>
                                <form method="post" style="display: contents;" action="{{route('patient.doctor.update',$meet->id)}}" class="form-contents">
                                    @method('PATCH')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Отметить заявку</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
