<table>

    @foreach($doctorInfo as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td><a href="{{route('appointment.index',$user->id)}}">{{$user->name}}</a></td>
            <td>{{$user->last_name}}</td>
            <td>{{$user->patronymic}}</td>
            <td>{{$user->email}}</td>
            @foreach($user->specials as $special)
            <td>{{$special->name}}</td>
            @endforeach
        </tr>
    @endforeach



</table>
