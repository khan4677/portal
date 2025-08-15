@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto py-8 space-y-6">
    <h1 class="text-2xl font-bold">Teacher Dashboard</h1>

    <div class="grid md:grid-cols-3 gap-6">
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex items-center justify-between mb-2">
                <h2 class="font-semibold">Students</h2>
            </div>
            <ul class="space-y-2">
                @foreach($students as $s)
                    <li class="text-sm">{{ $s->name }} ({{ $s->student_id }}) — {{ $s->email }}</li>
                @endforeach
            </ul>
            <div class="mt-3">{{ $students->links() }}</div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex items-center justify-between mb-2">
                <h2 class="font-semibold">Assignments</h2>
                <a href="{{ route('assignments.create') }}" class="text-blue-600 underline">New</a>
            </div>
            <ul class="space-y-2">
                @foreach($assignments as $a)
                    <li class="flex flex-col gap-2 mb-2">
                        <div class="flex items-center justify-between">
                            <a class="text-blue-700" href="{{ route('assignments.show',$a) }}">{{ $a->title }}</a>
                            <span class="text-gray-600">Submissions: {{ $a->submissions_count }}</span>
                        </div>
                        <form method="POST" action="{{ route('assignments.store') }}" class="flex gap-2 items-center">
                            @csrf
                            <input type="text" name="title" class="border rounded p-1 w-1/2" placeholder="New assignment title..." required />
                            <input type="date" name="due_date" class="border rounded p-1 w-1/3" required />
                            <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Create Assignment</button>
                        </form>
                    </li>
                @endforeach
            </ul>
            <div class="mt-3">{{ $assignments->links() }}</div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex items-center justify-between mb-2">
                <h2 class="font-semibold">Inbox</h2>
                <a href="{{ route('messages.index') }}" class="text-blue-600 underline">Open</a>
            </div>
            <ul class="space-y-2">
                @foreach($messages as $m)
                    <li class="text-sm">
                        <a class="text-blue-700" href="{{ route('messages.show',$m) }}">{{ $m->subject }}</a>
                    </li>
                @endforeach
            </ul>
            <form method="POST" action="{{ route('messages.index') }}" class="mt-4 flex gap-2 items-center">
                @csrf
                <input type="text" name="subject" class="border rounded p-1 w-1/3" placeholder="Subject..." required />
                <input type="text" name="body" class="border rounded p-1 w-1/2" placeholder="Message..." required />
                <button type="submit" class="px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700">Send Message</button>
            </form>
        </div>
    </div>

    <div class="bg-white p-4 rounded-lg shadow">
        <a href="{{ route('results.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">Publish Result</a>
    </div>
</div>
@endsection
