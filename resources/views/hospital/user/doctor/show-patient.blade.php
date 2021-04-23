@extends('hospital.layouts.app')
@section('content')
    <link href="/user/profile/css/profile.css" rel="stylesheet">
<div class="container bootstrap snippets bootdey panel">
    <div class="row">
        <div class="find-panel " style="margin-top: 20px;">
            <div class="form-group col-md-2">
                <select class="form-control" id="select-status">
                    <option value="">Усі записи</option>
                    <option value="1">Завершені</option>
                    <option value="0">В роботі</option>
                </select>
            </div>
            <div class="form-group col-md-10">
                <input name="last_name" type="text" class="form-control" id="patient-search" placeholder="Пацієнт">
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
                    <tbody id="data-meet">

                    @include('hospital.user.doctor.show-data-patient')

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
</div>
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    @include('scripts.doctors.script-ajax-search-meet')
@endsection
