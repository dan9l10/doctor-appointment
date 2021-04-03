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
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Status</th>
                        <th scope="col">Patient</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($meets as $meet)
                        <tr>
                            <td >{{$meet->date}}</td>
                            <td >{{$meet->times->time}}</td>
                            <td>{{$meet->status}}</td>
                            <td>{{$meet->patient->name}} {{$meet->patient->last_name}}</td>
                            <td><a class="btn btn-primary mr-2" href="{{route('meets.admin.edit',$meet->id)}}" role="button">Изменить</a>
                                <form method="post" style="display: contents;" action="{{route('meets.admin.destroy',$meet->id)}}" class="form-contents">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Удалить</button>
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
