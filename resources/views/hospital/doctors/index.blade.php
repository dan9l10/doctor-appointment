@extends('hospital.layouts.app')
@section('content')
    <link href="/user/profile/css/profile.css" rel="stylesheet">
    <link href="/css/doctor-info-style.css" rel="stylesheet">
    <div class="row">
        <div class="col-md-12 find-panel panel">
            <div class="form-group container">
                <input name="search-doc" type="text" class="form-control" id="search-doc" placeholder="Введіть ім'я або прізвище">
            </div>
        </div>
    </div>
    <div class="container main-container-style" >
        <div class="row no-gutters">
            <div class="col-md-4" >
                <div class="row">
                    <div class="col-md-12 panel">
                        <h2 style="margin-bottom: 5px; border-bottom: 1px solid #939ba2;">Фільтри: </h2>
                        <h3 style="margin-bottom: 5px;">За спеціальностями:</h3>
                        @foreach($specials as $special)
                        <div style="margin-bottom:3px; " class="form-check">
                            <input class="form-check-input special_checkbox" type="checkbox" attr-name="{{$special->name}}" name="special[]" value="{{$special->id}}" id="{{$special->id}}">
                            <label class="form-check-label name-doctor" for="{{$special->id}}">
                               {{$special->name}}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-8" id="doc_card">
                @include('hospital.doctors.doctor-data')
            </div>
            <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
        </div>
    </div>
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>

    @include('scripts.doctors.script-ajax-update-doctor')

@endsection
