@extends('hospital.layouts.app')

@section('content')
{{$appointments->user->name}}

@foreach($appointments->times as $time)
{{$time->time}}
@endforeach



@endsection
