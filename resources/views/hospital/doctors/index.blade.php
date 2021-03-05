<table>

    @foreach($doctorInfo as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->name}}</td>
            @foreach($user->specials as $special)
            <td>{{$special->name}}</td>
            @endforeach
        </tr>
    @endforeach



</table>
