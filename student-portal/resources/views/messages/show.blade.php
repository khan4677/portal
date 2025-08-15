@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto py-8 space-y-4">
    <div class="bg-white p-6 rounded-lg shadow">
        <h1 class="text-xl font-bold mb-2">{{ $message->subject }}</h1>
        <div class="text-sm text-gray-600 mb-4">From: {{ $message->sender->name }} ({{ $message->sender->email }})</div>
        <p class="whitespace-pre-line">{{ $message->body }}</p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-semibold mb-3">Reply</h2>
        <form method="POST" action="{{ route('messages.reply',$message) }}" class="space-y-3">
            @csrf
            <textarea name="reply_body" rows="4" class="w-full border rounded p-2" required>{{ old('reply_body',$message->reply_body) }}</textarea>
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Send Reply</button>
        </form>
    </div>
</div>
@endsection
