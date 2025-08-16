@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 space-y-8">

    <!-- Dashboard Header -->
    <div class="text-center">
        <h1 class="text-3xl font-extrabold text-gray-900">Student Dashboard</h1>
        <p class="mt-2 text-gray-600">Welcome back! Here’s an overview of your assignments, submissions, and results.</p>
    </div>

    <!-- Dashboard Cards -->
    <div class="grid md:grid-cols-3 gap-6">

        <!-- Assignments -->
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300">
            <h2 class="font-semibold text-xl mb-4 text-gray-800">Assignments</h2>
            <ul class="space-y-3">
                @forelse($assignments as $a)
                    <li class="flex flex-col gap-2 p-3 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition">
                        <div class="flex items-center justify-between">
                            <span class="font-medium text-gray-700">{{ $a->title }}</span>
                            @if($a->due_date)<span class="text-sm text-gray-500">Due: {{ $a->due_date }}</span>@endif
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('assignments.show', $a) }}" class="px-4 py-1 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">View</a>
                            <a href="{{ route('assignments.show', $a) }}#submit" class="px-4 py-1 bg-green-600 text-white font-semibold rounded hover:bg-green-700 transition">Submit</a>
                        </div>
                    </li>
                @empty
                    <li class="text-center text-gray-500 py-4">
                        No assignments available.
                    </li>
                @endforelse
            </ul>
            <div class="mt-4">{{ $assignments->links() }}</div>
        </div>

        <!-- Your Submissions -->
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300">
            <h2 class="font-semibold text-xl mb-4 text-gray-800">Your Submissions</h2>
            <ul class="space-y-3">
                @foreach($submissions as $s)
                    <li class="flex flex-col gap-2 p-3 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700 text-sm">{{ $s->assignment->title }} — <span class="capitalize">{{ $s->status }}</span>@if($s->grade) | Grade: {{ $s->grade }} @endif</span>
                            <a href="{{ route('submissions.show', $s) }}" class="px-4 py-1 bg-purple-600 text-white font-semibold rounded hover:bg-purple-700 transition">View</a>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="mt-4">{{ $submissions->links() }}</div>
        </div>

        <!-- Results -->
        <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300 flex flex-col justify-between">
            <h2 class="font-semibold text-xl mb-4 text-gray-800">Results</h2>
            <p class="text-gray-600 mb-4">Check all your grades and results for your courses.</p>
            <a href="{{ route('results.student') }}" class="mt-auto inline-block px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 font-semibold transition text-center">View All Results</a>
        </div>

    </div>

    <!-- Contact Admin -->
    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition duration-300">
        <h2 class="font-semibold text-xl mb-4 text-gray-800">Contact Admin / Teacher</h2>
        @if(session('status'))
            <div class="p-3 bg-green-100 text-green-800 rounded mb-4">{{ session('status') }}</div>
        @endif
        <form method="POST" action="{{ route('student.message.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700 font-medium mb-1">Subject</label>
                <input name="subject" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required />
                @error('subject')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Message</label>
                <textarea name="body" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" rows="5" required></textarea>
                @error('body')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>
            <button class="px-5 py-2 bg-blue-600 text-white rounded font-semibold hover:bg-blue-700 transition">Send Message</button>
        </form>
    </div>

</div>
@endsection
