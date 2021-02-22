@extends('layouts.app')

@section('content')
    <a class="btn btn-primary" href="{{ route('users.admin.create') }}">Добавить</a>

    <table class="table table-hover mt-2">
    <tbody>
        @foreach($users as $user)
            @php /** @var \App\Models\User $user */ @endphp
            <tr>
                <td>{{$user->id}}</td>
                <td><a href=" {{ route('users.admin.edit', $user->id) }}">{{$user->name}}</a></td>
                <td>{{$user->email}}</td>
                <td>{{$user->role}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $users->links() }}
@endsection


