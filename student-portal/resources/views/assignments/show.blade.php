@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto py-8 space-y-6">
    <div class="bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-2">{{ $assignment->title }}</h1>
        <div class="text-sm text-gray-600 mb-4">
            By {{ $assignment->creator->name }} @if($assignment->due_date) • Due {{ $assignment->due_date }} @endif
        </div>
        @if($assignment->attachment_path)
            <a class="text-blue-700 underline" href="{{ asset('storage/'.$assignment->attachment_path) }}" target="_blank">Download Attachment</a>
        @endif
        <p class="mt-4 whitespace-pre-line">{{ $assignment->description }}</p>
    </div>

    @if(auth()->user()->isStudent())
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-3">Submit Your Work</h2>
        @if(session('status'))<div class="p-2 bg-green-100 rounded mb-3">{{ session('status') }}</div>@endif
        <form method="POST" action="{{ route('submissions.store',$assignment) }}" enctype="multipart/form-data" class="space-y-3">
            @csrf
            <div>
                <label class="block text-sm mb-1">Message (optional)</label>
                <textarea name="message" class="w-full border rounded p-2" rows="3"></textarea>
            </div>
            <div>
                <label class="block text-sm mb-1">File</label>
                <input type="file" name="file" class="w-full border rounded p-2" />
            </div>
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Submit</button>
        </form>
    </div>
    @endif

    @if(auth()->user()->isTeacher())
    <div class="bg-white p-6 rounded-lg shadow">
        <a href="{{ route('submissions.index',$assignment) }}" class="px-4 py-2 bg-indigo-600 text-white rounded">View Submissions</a>
    </div>
    @endif
</div>
@endsection
