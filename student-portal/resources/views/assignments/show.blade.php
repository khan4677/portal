@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-8">

    <!-- Assignment Details Card -->
    <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white rounded-2xl shadow-lg p-6 hover:shadow-2xl transition duration-300">
        <h1 class="text-3xl font-extrabold mb-2">{{ $assignment->title }}</h1>
        <div class="text-sm text-indigo-100 mb-4">
            By {{ $assignment->creator->name }}
            @if($assignment->due_date) • Due {{ $assignment->due_date }} @endif
        </div>
        @if($assignment->attachment_path)
            <a class="inline-block mb-4 px-3 py-1 bg-white text-indigo-600 font-semibold rounded hover:bg-gray-100 transition" href="{{ asset('storage/'.$assignment->attachment_path) }}" target="_blank">Download Attachment</a>
        @endif
        <p class="mt-4 whitespace-pre-line text-indigo-100">{{ $assignment->description }}</p>
    </div>

    <!-- Student Submission Form -->
    @if(auth()->user()->role === 'student')
    <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Submit Your Work</h2>
        @if(session('status'))<div class="p-3 bg-green-100 text-green-800 rounded mb-4">{{ session('status') }}</div>@endif
        <form method="POST" action="{{ route('submissions.store', $assignment) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700 font-medium mb-1">Message (optional)</label>
                <textarea name="message" class="w-full border-2 border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none" rows="3"></textarea>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">File</label>
                <input type="file" name="file" class="w-full border-2 border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none" />
            </div>
            <button class="w-full px-5 py-3 bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 text-white font-semibold rounded-lg hover:scale-105 transform transition shadow-lg">Submit</button>
        </form>
    </div>
    @endif

    <!-- Teacher View Submissions Button -->
    @if(auth()->user()->role === 'teacher')
    <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 text-center">
        <a href="{{ route('submissions.index', $assignment) }}" class="inline-block px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition shadow-lg">View Submissions</a>
    </div>
    @endif

</div>
@endsection
