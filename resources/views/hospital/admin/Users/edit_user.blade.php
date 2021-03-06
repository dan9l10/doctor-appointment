@extends('hospital.admin.layouts.admin_app')

@section('content')
    <div class="container">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p></p>
            </div>
        @endif
    <form class="ml-2" method="post" action="{{route('users.admin.update',$userEdit->id)}}">
        @method('PATCH')
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input name="email" type="email" class="form-control" id="inputEmail4" value="{{$userEdit->email}}">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Password</label>
                <input  name="password" type="password" class="form-control" id="inputPassword4" placeholder="Password">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputName">Name</label>
                <input name="name" type="text" class="form-control" id="inputName" value="{{$userEdit->name}}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Address</label>
            <input name="address" type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input name="city" type="text" class="form-control" id="inputCity">
            </div>
            <div class="form-group col-md-4">
                <label for="inputRole">Role</label>
                <select name="role" id="inputRole" class="form-control">
                    @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">DOB</label>
                <input name="DOB" type="date" class="form-control ui-datepicker" id="inputZip">
            </div>
            @if(($userEdit->role)=='doctor')
            <div class="form-group col-md-2">
                <label for="special">Specials</label>
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
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>

@endsection
