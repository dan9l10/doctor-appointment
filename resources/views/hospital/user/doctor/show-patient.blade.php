@extends('hospital.layouts.app')
@section('content')
    <link href="/user/profile/css/profile.css" rel="stylesheet">
<div class="container bootstrap snippets bootdey panel">
    <div class="row">
        <div class="find-panel " style="margin-top: 20px;">
            <div class="form-group col-md-2">
                <select class="form-control">
                    <option>Статус запису</option>
                    <option>Завершені</option>
                    <option>В роботі</option>
                </select>
            </div>
            <div class="form-group col-md-10">
                <input name="last_name" type="text" class="form-control" id="last_name" placeholder="Пацієнт">
            </div>
        </div>
    </div>
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
    <div class="row">
        <div class="">
            <div class="panel-body">
                <table class="table table-striped ">
                    <thead class="thead-light" >
                    <tr>
                        <th scope="col">Дата</th>
                        <th scope="col">Час</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Пацієнт</th>
                        <th scope="col">Тип зустрічі</th>
                    </tr>
                    </thead>
                    <tbody>

                    @include('hospital.user.doctor.show-data-patient')

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
