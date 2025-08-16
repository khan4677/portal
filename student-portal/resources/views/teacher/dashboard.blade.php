@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-8">

    <!-- Dashboard Header -->
    <div class="text-center mb-6">
        <h1 class="text-3xl font-extrabold text-gray-900">Teacher Dashboard</h1>
        <p class="text-gray-600 mt-1">Manage students, assignments, inbox, and results</p>
    </div>

    <!-- Dashboard Grid -->
    <div class="grid md:grid-cols-3 gap-6">

        <!-- Students Card -->
        <div class="bg-gradient-to-r from-blue-100 via-blue-50 to-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition duration-300">
            <h2 class="text-xl font-semibold mb-3 text-blue-800">Students</h2>
            <ul class="space-y-2 max-h-64 overflow-y-auto">
                @foreach($students as $s)
                    <li class="text-gray-700 text-sm">{{ $s->name }} ({{ $s->student_id }})</li>
                @endforeach
            </ul>
            <div class="mt-3">{{ $students->links() }}</div>
        </div>

        <!-- Assignments Card -->
        <div class="bg-gradient-to-r from-purple-100 via-pink-50 to-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition duration-300">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-xl font-semibold text-purple-800">Assignments</h2>
                <a href="{{ route('assignments.create') }}" class="px-3 py-1 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">New</a>
            </div>
            <ul class="space-y-4 max-h-96 overflow-y-auto">
                @foreach($assignments as $a)
                    <li class="bg-white rounded-lg shadow-sm p-3">
                        <div class="flex items-center justify-between">
                            <a class="text-purple-700 font-semibold" href="{{ route('assignments.show',$a) }}">{{ $a->title }}</a>
                            <span class="text-gray-500 text-sm">Submissions: {{ $a->submissions_count }}</span>
                        </div>
                        @if($a->submissions_count > 0)
                        <div class="ml-4 mt-2">
                            <h3 class="font-semibold text-sm mb-1">Submissions:</h3>
                            <ul class="list-disc pl-4 text-gray-700 text-sm">
                                @foreach($a->submissions as $submission)
                                    <li>
                                        Student: {{ $submission->student->name ?? 'Unknown' }} ({{ $submission->student_id }})
                                        <a href="{{ route('submissions.show', $submission) }}" class="text-indigo-600 underline ml-2">View</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </li>
                @endforeach
            </ul>
            <div class="mt-3">{{ $assignments->links() }}</div>
        </div>

        <!-- Inbox Card -->
        <div class="bg-gradient-to-r from-green-100 via-green-50 to-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition duration-300">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-xl font-semibold text-green-800">Inbox</h2>
                <a href="{{ route('messages.index') }}" class="px-3 py-1 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">Open</a>
            </div>
            <ul class="space-y-2 max-h-64 overflow-y-auto">
                @foreach($messages as $m)
                    <li class="text-gray-700 text-sm">
                        <a class="text-green-700 font-medium" href="{{ route('messages.show',$m) }}">{{ $m->subject }}</a>
                    </li>
                @endforeach
            </ul>
            <form method="POST" action="{{ route('messages.index') }}" class="mt-4 flex gap-2 items-center">
                @csrf
                <input type="text" name="subject" class="border rounded p-1 w-1/3" placeholder="Subject..." required />
                <input type="text" name="body" class="border rounded p-1 w-1/2" placeholder="Message..." required />
                <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 transition">Send</button>
            </form>
        </div>
    </div>

    <!-- Publish Result Button -->
    <div class="bg-gradient-to-r from-indigo-100 via-blue-50 to-white rounded-2xl shadow-lg p-4 text-center">
        <a href="{{ route('results.create') }}" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">Publish Result</a>
    </div>

</div>
@endsection
