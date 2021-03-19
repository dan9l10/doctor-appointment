@extends('hospital.admin.layouts.admin_app')

@section('content')
    <a class="btn btn-primary m-2" href="{{ route('users.admin.create') }}">Добавить</a>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p></p>
        </div>
    @endif
    <table class="table table-striped ">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
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
                <td><a class="btn btn-primary mr-2" href=" {{ route('users.admin.edit', $user->id) }}" role="button">Изменить</a>
                    <form method="post" style="display: contents;" action="{{ route('users.admin.destroy',$user->id) }}" class="form-contents">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>


                </td>

            </tr>
        @endforeach
    </tbody>
</table>
{{ $users->links() }}
@endsection


