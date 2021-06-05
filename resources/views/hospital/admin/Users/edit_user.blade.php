@extends('hospital.admin.layouts.admin_app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{$message}}</p>
                    </div>
                @endif
                <form class="ml-2" method="post" action="{{route('users.admin.update',$userEdit->user->id)}}">
                    @method('PATCH')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input name="email" type="email" class="form-control" id="inputEmail4" value="{{$userEdit->user->email}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Пароль</label>
                            <input  name="password" type="password" class="form-control" id="inputPassword4" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputName">Ім'я</label>
                            <input name="name" type="text" class="form-control" id="inputName" value="{{$userEdit->user->name}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="last_name">Прізвище</label>
                            <input name="last_name" type="text" class="form-control" id="last_name" value="{{$userEdit->user->last_name}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="patronymic">По батькові</label>
                            <input name="patronymic" type="text" class="form-control" id="patronymic" value="{{$userEdit->user->patronymic}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone_number">Номер телефону</label>
                            <input name="phone_number" type="text" class="form-control" id="phone_number" value="{{$userEdit->phone}}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">Місто</label>
                            <input name="city" type="text" class="form-control" id="inputCity" value="{{$userEdit->city}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputAddress">Адреса</label>
                            <input name="address" type="text" class="form-control" id="inputAddress" value="{{$userEdit->address}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputRole">Роль користувача</label>
                            <select name="role" id="inputRole" class="form-control">
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="DOB">Дата народження</label>
                            <input name="DOB" type="date" class="form-control ui-datepicker" id="DOB" value="{{$userEdit->DOB}}">
                        </div>
                        @if(($userEdit->role)=='doctor')
                            <div class="form-group col-md-2">
                                <label for="special">Спеціальність лікаря</label>
                                <select name="special">
                                    @foreach($specials as $special)
                                        <option value="{{$special->id}}">{{$special->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                    </div>
                    <button type="submit" class="btn btn-primary">Зберегти</button>
                    <a href="{{route('users.admin.index')}}" class="btn ">Back</a>
                </form>
            </div>
        </div>

    </div>

@endsection
