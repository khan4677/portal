@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-6 space-y-6">
    <h1 class="text-2xl font-bold">Student Dashboard</h1>

    <div class="grid md:grid-cols-3 gap-6">
        <div class="bg-white p-4 rounded-lg shadow">
            <h2 class="font-semibold mb-3">Assignments</h2>
            <ul class="space-y-2">
                @forelse($assignments as $a)
                    <li class="flex flex-col gap-2 mb-2">
                        <div class="flex items-center justify-between">
                            <span>{{ $a->title }}</span>
                            @if($a->due_date)<span class="text-sm text-gray-500">Due: {{ $a->due_date }}</span>@endif
                        </div>
                        <div class="flex gap-2 items-center">
                            <a href="{{ route('assignments.show', $a) }}" class="px-3 py-1 bg-black text-black font-bold rounded shadow hover:bg-gray-900">View Assignment</a>
                            <a href="{{ route('assignments.show', $a) }}#submit" class="px-3 py-1 bg-black text-black font-bold rounded shadow hover:bg-gray-900">Submit Assignment</a>
                        </div>
                    </li>
                @empty
                    <li class="flex flex-col gap-2 mb-2">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500">No assignments available.</span>
                        </div>
                        <div class="flex gap-2 items-center">
                            <button class="px-3 py-1 bg-black text-black font-bold rounded shadow cursor-not-allowed" disabled title="No assignments available">View Assignment</button>
                            <button class="px-3 py-1 bg-black text-black font-bold rounded shadow cursor-not-allowed" disabled title="No assignments available">Submit Assignment</button>
                        </div>
                        <div class="mt-2 text-sm text-gray-700">Assignments will appear here when available. Students cannot add assignments.</div>
                        </div>
                    </li>
                @endforelse
            </ul>
            <div class="mt-3">{{ $assignments->links() }}</div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow">
            <h2 class="font-semibold mb-3">Your Submissions</h2>
            <ul class="space-y-2">
                @foreach($submissions as $s)
                    <li class="flex flex-col gap-2 mb-2">
                        <div class="flex items-center justify-between">
                            <span class="text-sm">{{ $s->assignment->title }} — <span class="capitalize">{{ $s->status }}</span>@if($s->grade) | Grade: {{ $s->grade }} @endif</span>
                            <a href="{{ route('submissions.show', $s) }}" class="px-3 py-1 bg-black text-black font-bold rounded shadow hover:bg-gray-900">View Submission</a>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="mt-3">{{ $submissions->links() }}</div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow">
            <h2 class="font-semibold mb-3">Results</h2>
            <a class="text-blue-600 underline" href="{{ route('results.student') }}">View all results</a>
        </div>
    </div>

    <div class="bg-white p-4 rounded-lg shadow">
        <h2 class="font-semibold mb-3">Contact Admin/Teacher</h2>
        @if(session('status'))<div class="p-2 bg-green-100 rounded mb-3">{{ session('status') }}</div>@endif
        <form method="POST" action="{{ route('student.message.store') }}" class="space-y-3">
            @csrf
            <div>
                <label class="block text-sm mb-1">Subject</label>
                <input name="subject" class="w-full border rounded p-2" required />
                @error('subject')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block text-sm mb-1">Message</label>
                <textarea name="body" class="w-full border rounded p-2" rows="4" required></textarea>
                @error('body')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Send</button>
        </form>
    </div>
</div>
@endsection
