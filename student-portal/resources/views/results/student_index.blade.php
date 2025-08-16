@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    <!-- Page Header -->
    <div class="text-center mb-10">
        <h1 class="text-4xl font-extrabold text-gray-900">My Results</h1>
        <p class="text-gray-600 mt-2">Your grades, marks, and progress in each subject.</p>
    </div>

    <!-- Results Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($results as $r)
        <div class="relative rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1">
            <!-- Background gradient -->
            <div class="absolute inset-0 bg-gradient-to-tr
                @if($r->grade == 'A') from-green-400 to-green-600
                @elseif($r->grade == 'B') from-yellow-400 to-yellow-600
                @elseif($r->grade == 'C') from-orange-400 to-orange-600
                @elseif($r->grade == 'F') from-red-400 to-red-600
                @else from-indigo-400 to-indigo-600
                @endif
            opacity-30"></div>

            <div class="relative p-6 bg-white rounded-3xl h-full flex flex-col justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-3">{{ $r->subject }}</h2>
                    <div class="flex items-center mb-2">
                        <span class="text-gray-500 text-sm mr-2">Term:</span>
                        <span class="font-semibold text-gray-700">{{ $r->term }}</span>
                    </div>
                    <div class="flex items-center mb-2">
                        <span class="text-gray-500 text-sm mr-2">Marks:</span>
                        <span class="font-semibold text-gray-700">{{ $r->marks }}/100</span>
                    </div>
                    <div class="flex items-center mb-2">
                        <span class="text-gray-500 text-sm mr-2">Published:</span>
                        <span class="text-gray-600">{{ $r->published_at ? $r->published_at->format('Y-m-d') : '-' }}</span>
                    </div>
                </div>

                <!-- Grade Badge -->
                <div class="mt-4">
                    <span class="inline-block px-4 py-2 rounded-full text-white font-semibold
                        @if($r->grade == 'A') bg-green-600
                        @elseif($r->grade == 'B') bg-yellow-600
                        @elseif($r->grade == 'C') bg-orange-600
                        @elseif($r->grade == 'F') bg-red-600
                        @else bg-indigo-600
                        @endif
                    ">{{ $r->grade }}</span>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center p-10 bg-gray-50 rounded-2xl shadow">
            <p class="text-gray-500 text-lg">No results available yet.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-10">
        {{ $results->links('pagination::tailwind') }}
    </div>
</div>
@endsection
