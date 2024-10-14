@extends('layouts.dashboard_master')

@section('content')
    <h1>Messages for {{ $salon->name }}</h1>

    <ul>
        @foreach($messages as $message)
            <li>{{ $message->content }} - {{ $message->user->name }}</li>
        @endforeach
    </ul>
@endsection
