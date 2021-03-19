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
    <div class="container">
<form action="{{route('appointments.admin.store')}}" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
            Choose date
        </div>
        <div class="card-body">
            {{--<input type="text" class="form-control datetimepicker-input" id="datepicker" data-toggle="datetimepicker" data-target="#datepicker" name="date">--}}
            <input type="date" class="form-control" name="date" value="{{ empty(old('date'))? date('Y-m-d') : old('date')}}">
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Choose doctor
        </div>
        <div class="card-body">
            <select class="form-control" name="doctor">
                @foreach($doctors as $doctor)
                <option value="{{$doctor->id}}">{{$doctor->name}} {{$doctor->last_name}} {{$doctor->patronymic}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Choose AM time
            <span style="margin-left: 700px">Check/Uncheck
               <input type="checkbox" onclick=" for(c in document.getElementsByName('time[]')) document.getElementsByName('time[]').item(c).checked=this.checked" >
           </span>
        </div>
        <div class="card-body">

            <table class="table table-striped">


                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td><input type="checkbox" name="time[]"  value="9:00">9</td>
                    <td><input type="checkbox" name="time[]"  value="9:30">9:30</td>
                    <td><input type="checkbox" name="time[]"  value="10:00">10</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td><input type="checkbox" name="time[]"  value="10:30">10:30</td>
                    <td><input type="checkbox" name="time[]"  value="11:00">11</td>
                    <td><input type="checkbox" name="time[]"  value="11:30">11:30</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td><input type="checkbox" name="time[]"  value="12:00">12</td>
                    <td><input type="checkbox" name="time[]"  value="12:30">12:30</td>
                    <td><input type="checkbox" name="time[]"  value="13:00">13</td>
                </tr>

                <tr>
                    <th scope="row">4</th>
                    <td><input type="checkbox" name="time[]"  value="13:30">13:30</td>
                    <td><input type="checkbox" name="time[]"  value="14:00">14</td>
                    <td><input type="checkbox" name="time[]"  value="14:30">14:30</td>
                </tr>

                <tr>
                    <th scope="row">5</th>
                    <td><input type="checkbox" name="time[]"  value="15:00">15</td>
                    <td><input type="checkbox" name="time[]"  value="15:30">15:30</td>
                    <td><input type="checkbox" name="time[]"  value="16:00">16</td>
                </tr>

                <tr>
                    <th scope="row">6</th>
                    <td><input type="checkbox" name="time[]"  value="16:30">16:30</td>
                    <td><input type="checkbox" name="time[]"  value="17:00">17</td>
                    <td><input type="checkbox" name="time[]"  value="17:30">17:30</td>
                </tr>
                <tr>
                    <th scope="row">7</th>
                    <td><input type="checkbox" name="time[]"  value="18:00">18</td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
    <div>
@endsection
