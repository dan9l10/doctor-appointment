@extends('hospital.admin.layouts.admin_app')

@section('content')
    <div class="container h-auto">
        <div class="card">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Error!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body">
                <form method="post" action="{{ route('users.admin.store') }}" >
                    @method('POST')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input name="email" type="email" class="form-control" id="inputEmail4" placeholder="Email" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Пароль</label>
                            <input name="password" type="password" class="form-control" id="inputPassword4" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputName">Имя</label>
                            <input name="name" type="text" class="form-control" id="inputName" placeholder="Your name" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="last_name">Фамилия</label>
                            <input name="last_name" id="last_name" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="patronymic">Отчество</label>
                            <input name="patronymic" type="text" class="form-control" id="patronymic" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone_number">Номер телефона</label>
                            <input name="phone_number" type="text" class="form-control" id="phone_number" placeholder="+38(___) ___ __ __" >
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputRole">Роль</label>
                            <select name="role" id="inputRole" class="form-control" >
                                @foreach($roles as $role)
                                    <option value="{{$role->name}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputState">Special</label>
                            <select name="special" id="inputState" class="form-control">
                                <option value="">Выберите специализацию</option>
                                @foreach($specials as $special)
                                    <option value="{{$special->id}}">{{$special->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">City</label>
                            <input name="city" type="text" class="form-control" id="inputCity">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="DOB">DOB</label>
                            <input name="date"  type="date" class="form-control" id="DOB">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>

    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script>
        $('#phone_number').mask("+389999999999");
    </script>



@endsection
