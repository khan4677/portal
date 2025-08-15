@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto py-8 space-y-4">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Assignments</h1>
        @if(auth()->user()->isTeacher())
            <a href="{{ route('assignments.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">New Assignment</a>
        @endif
    </div>
    <div class="bg-white rounded-lg shadow divide-y">
        @foreach($assignments as $a)
        <div class="p-4 flex items-center justify-between">
            <div>
                <a href="{{ route('assignments.show',$a) }}" class="text-lg text-blue-700 font-semibold">{{ $a->title }}</a>
                <div class="text-sm text-gray-600">
                    By {{ $a->creator->name }} @if($a->due_date) • Due {{ $a->due_date }} @endif
                </div>
            </div>
            @if(auth()->user()->isTeacher())
            <div class="space-x-2">
                <a href="{{ route('assignments.edit',$a) }}" class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>
                <form action="{{ route('assignments.destroy',$a) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button class="px-3 py-1 bg-red-600 text-white rounded" onclick="return confirm('Delete?')">Delete</button>
                </form>
            </div>
            @endif
        </div>
        @endforeach
    </div>
    <div>{{ $assignments->links() }}</div>
</div>
@endsection
