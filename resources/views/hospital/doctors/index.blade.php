@extends('hospital.layouts.app')
@section('content')
    <link href="/user/profile/css/profile.css" rel="stylesheet">
    <style>
        .card-doc {
            width: 75%;
            display: flex;
        }

        .container-card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        .container-card-info {
            padding: 2px 16px;

        }
        .container-card{
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            align-content: end;
            background: #fff;
            margin-bottom: 15px ;
            border-radius: 7px;
        }
        .find-panel{
           padding-top: 10px;
        }
        .main-container-style{
            margin-top: 10px;
        }
    </style>
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
                            <input style=" transform:scale(1.3);  opacity:0.9; cursor:pointer; margin-right: 2px; color: #000;" class="form-check-input special_checkbox" type="checkbox" attr-name="{{$special->name}}" name="special[]" value="{{$special->id}}" id="{{$special->id}}">
                            <label style="font-size: 15px; " class="form-check-label" for="{{$special->id}}">
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
