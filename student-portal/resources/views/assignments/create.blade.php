@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto py-8">
    <div class="bg-white p-6 rounded-lg shadow">
        <h1 class="text-xl font-bold mb-4">Create Assignment</h1>
        <form method="POST" action="{{ route('assignments.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm mb-1">Title</label>
                <input name="title" class="w-full border rounded p-2" required />
                @error('title')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="block text-sm mb-1">Description</label>
                <textarea name="description" class="w-full border rounded p-2" rows="4"></textarea>
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm mb-1">Due Date</label>
                    <input type="date" name="due_date" class="w-full border rounded p-2" />
                </div>
                <div>
                    <label class="block text-sm mb-1">Attachment (optional)</label>
                    <input type="file" name="attachment" class="w-full border rounded p-2" />
                </div>
            </div>
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Create</button>
        </form>
    </div>
</div>
@endsection
