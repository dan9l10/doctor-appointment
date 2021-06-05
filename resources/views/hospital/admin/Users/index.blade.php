@extends('hospital.admin.layouts.admin_app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
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
                <a class="btn btn-primary m-2" href="{{ route('users.admin.create') }}">Створити</a>
            </div>
            <div class="card-body">
                <table class="table table-striped ">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ім'я</th>
                        <th scope="col">Email</th>
                        <th scope="col">Роль</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $user)
                        @php /** @var \App\Models\User $user */ @endphp
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role}}</td>
                            <td><a class="btn btn-primary mr-2" href=" {{ route('users.admin.edit', $user->id) }}" role="button">Змінити</a>
                                <form method="post" style="display: contents;" action="{{ route('users.admin.destroy',$user->id) }}" class="form-contents">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Видалити</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection


