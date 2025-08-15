@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto py-8 space-y-4">
    <h1 class="text-2xl font-bold">Submissions — {{ $assignment->title }}</h1>
    <div class="bg-white rounded-lg shadow divide-y">
        @foreach($submissions as $s)
        <div class="p-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="font-semibold">{{ $s->student->name }} ({{ $s->student->student_id }})</div>
                    <div class="text-sm text-gray-600">Status: {{ $s->status }} @if($s->grade) | Grade: {{ $s->grade }} @endif</div>
                    @if($s->file_path)
                        <a class="text-blue-700 underline" href="{{ asset('storage/'.$s->file_path) }}" target="_blank">Download File</a>
                    @endif
                    @if($s->message)<p class="mt-2 text-sm">{{ $s->message }}</p>@endif
                </div>
                <form method="POST" action="{{ route('submissions.grade',$s) }}" class="flex items-center space-x-2">
                    @csrf
                    <input type="number" step="0.01" min="0" max="100" name="grade" value="{{ old('grade',$s->grade) }}" class="border rounded p-2 w-28" placeholder="Grade" required />
                    <input type="text" name="feedback" value="{{ old('feedback',$s->feedback) }}" class="border rounded p-2" placeholder="Feedback (optional)" />
                    <button class="px-3 py-2 bg-green-600 text-white rounded">Save</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    <div>{{ $submissions->links() }}</div>
</div>
@endsection
