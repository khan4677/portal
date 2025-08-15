@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto py-8 space-y-4">
    <h1 class="text-2xl font-bold">My Results</h1>
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left p-3">Subject</th>
                    <th class="text-left p-3">Term</th>
                    <th class="text-left p-3">Marks</th>
                    <th class="text-left p-3">Grade</th>
                    <th class="text-left p-3">Published</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $r)
                <tr class="border-t">
                    <td class="p-3">{{ $r->subject }}</td>
                    <td class="p-3">{{ $r->term }}</td>
                    <td class="p-3">{{ $r->marks }}</td>
                    <td class="p-3">{{ $r->grade }}</td>
                    <td class="p-3">{{ $r->published_at? $r->published_at->format('Y-m-d') : '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>{{ $results->links() }}</div>
</div>
@endsection
