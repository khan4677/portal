@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto py-8 space-y-4">
    <h1 class="text-2xl font-bold">Inbox</h1>
    <div class="bg-white rounded-lg shadow divide-y">
        @foreach($messages as $m)
        <a href="{{ route('messages.show',$m) }}" class="block p-4 hover:bg-gray-50">
            <div class="flex items-center justify-between">
                <div>
                    <div class="font-semibold">{{ $m->subject }}</div>
                    <div class="text-sm text-gray-600">From: {{ $m->sender->name }} ({{ $m->sender->email }})</div>
                </div>
                <span class="text-xs px-2 py-1 rounded {{ $m->status==='answered' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">{{ ucfirst($m->status) }}</span>
            </div>
        </a>
        @endforeach
    </div>
    <div>{{ $messages->links() }}</div>
</div>
@endsection
