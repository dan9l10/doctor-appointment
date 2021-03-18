@extends('hospital.admin.layouts.admin_app')

@section('content')
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
    @if(!empty($meets))
    <table class="table table-striped ">
        <thead>
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Time</th>
            <th scope="col">Status</th>
            <th scope="col">Patient</th>
            <th scope="col">Doctor</th>
        </tr>
        </thead>
        <tbody>

        @foreach($meets as $meet)
            <tr>
                <td >{{$meet->date}}</td>
                <td >{{$meet->times->time}}</td>
                <td>{{$meet->status}}</td>
                <td>{{$meet->patient->name}} {{$meet->patient->last_name}}</td>
                <td>{{$meet->doctor->name}} {{$meet->doctor->last_name}}</td>
                <td><a class="btn btn-primary mr-2" href="{{route('meets.admin.edit',$meet->id)}}" role="button">Изменить</a>
                    <form method="post" style="display: contents;" action="{{route('meets.admin.destroy',$meet->id)}}" class="form-contents">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
        @else
            <p><b>Match not found</b></p>
        @endif
        </tbody>
    </table>
    {{ $meets->links() }}

@endsection
