@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto py-8">
    <div class="bg-white p-6 rounded-lg shadow">
        <h1 class="text-xl font-bold mb-4">Publish Result</h1>
        <form method="POST" action="{{ route('results.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm mb-1">Student</label>
                <select name="student_id" class="w-full border rounded p-2" required>
                    <option value="">Select student</option>
                    @foreach($students as $s)
                        <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->student_id }})</option>
                    @endforeach
                </select>
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm mb-1">Subject</label>
                    <input name="subject" class="w-full border rounded p-2" required />
                </div>
                <div>
                    <label class="block text-sm mb-1">Term</label>
                    <input name="term" class="w-full border rounded p-2" />
                </div>
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm mb-1">Marks</label>
                    <input type="number" step="0.01" min="0" max="100" name="marks" class="w-full border rounded p-2" />
                </div>
                <div>
                    <label class="block text-sm mb-1">Grade</label>
                    <input name="grade" class="w-full border rounded p-2" />
                </div>
            </div>
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Publish</button>
        </form>
    </div>
</div>
@endsection
