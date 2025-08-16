@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

    <!-- Page Header -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900">Submission Details</h1>
        <p class="text-gray-600 mt-2">View all the information about your assignment submission.</p>
    </div>

    <!-- Submission Card -->
    <div class="bg-white rounded-2xl shadow-lg p-6 space-y-4 hover:shadow-2xl transition duration-300">

        <div class="flex justify-between items-center">
            <span class="text-gray-700 font-semibold">Assignment ID:</span>
            <span class="text-gray-900 font-medium">{{ $submission->assignment_id }}</span>
        </div>

        <div class="flex justify-between items-center">
            <span class="text-gray-700 font-semibold">Student ID:</span>
            <span class="text-gray-900 font-medium">{{ $submission->student_id }}</span>
        </div>

        <div class="flex justify-between items-center">
            <span class="text-gray-700 font-semibold">Status:</span>
            <span class="px-3 py-1 rounded-full text-sm font-semibold
                @if($submission->status == 'submitted') bg-blue-100 text-blue-800
                @elseif($submission->status == 'pending') bg-yellow-100 text-yellow-800
                @elseif($submission->status == 'graded') bg-green-100 text-green-800
                @else bg-gray-100 text-gray-800
                @endif
            ">{{ ucfirst($submission->status) }}</span>
        </div>

        <div>
            <span class="text-gray-700 font-semibold">Message:</span>
            <p class="text-gray-900 mt-1">{{ $submission->message ?? 'N/A' }}</p>
        </div>

        <div>
            <span class="text-gray-700 font-semibold">File:</span>
            <p class="mt-1">
                @if($submission->file_path)
                    <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="text-blue-600 underline hover:text-blue-800">Download</a>
                @else
                    <span class="text-gray-500">No file submitted</span>
                @endif
            </p>
        </div>

        <div class="flex justify-between items-center">
            <span class="text-gray-700 font-semibold">Grade:</span>
            <span class="px-3 py-1 rounded-full text-sm font-semibold
                @if($submission->grade)
                    bg-green-100 text-green-800
                @else
                    bg-gray-100 text-gray-800
                @endif
            ">{{ $submission->grade ?? 'Not graded' }}</span>
        </div>

        <div>
            <span class="text-gray-700 font-semibold">Feedback:</span>
            <p class="text-gray-900 mt-1">{{ $submission->feedback ?? 'N/A' }}</p>
        </div>

    </div>

    <!-- Role-Based Links -->
    <div class="mt-6 text-center">
        @if(auth()->user()->role === 'teacher')
            <a href="{{ route('submissions.index', $submission->assignment) }}" class="inline-block px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition shadow">
                View All Submissions
            </a>
        @elseif(auth()->user()->role === 'student')
            <a href="{{ route('submissions.show', $submission->assignment) }}" class="inline-block px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition shadow">
                View My Submission
            </a>
        @endif
    </div>

    <!-- Back Button -->
    <div class="mt-4 text-center">
        <a href="{{ url()->previous() }}" class="inline-block px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition shadow">
            Back
        </a>
    </div>

</div>
@endsection
