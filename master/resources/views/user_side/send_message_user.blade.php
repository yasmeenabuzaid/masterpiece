@extends('layouts.app')

@section('content')
<div class="container">
    <h2>تحدث مع صالون: {{ $salon->name }}</h2>

    <form method="POST" action="{{ route('send.message') }}">
        @csrf
        <input type="hidden" name="salon_id" value="{{ $salon->id }}">
        <div class="form-group">
            <label for="message">اكتب رسالتك:</label>
            <textarea id="message" name="message" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">إرسال</button>
    </form>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <h3 class="mt-5">الرسائل:</h3>
    <ul class="list-group">
        @foreach($messages as $msg)
            <li class="list-group-item">
                <strong>{{ $msg->user->name }}:</strong> {{ $msg->content }}
                <small class="text-muted"> - {{ $msg->created_at->diffForHumans() }}</small>
            </li>
        @endforeach
    </ul>
</div>
@endsection
