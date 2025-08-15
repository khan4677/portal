@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto py-8">
    <div class="bg-white p-6 rounded-lg shadow">
        <h1 class="text-xl font-bold mb-4">Edit Profile</h1>
        @if(session('status'))<div class="p-2 bg-green-100 rounded mb-3">{{ session('status') }}</div>@endif
        <form method="POST" action="{{ route('student.profile.update') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm mb-1">Name</label>
                <input name="name" value="{{ old('name',$user->name) }}" class="w-full border rounded p-2" required />
                @error('name')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm mb-1">Student ID</label>
                    <input name="student_id" value="{{ old('student_id',$user->student_id) }}" class="w-full border rounded p-2" />
                </div>
                <div>
                    <label class="block text-sm mb-1">Phone</label>
                    <input name="phone" value="{{ old('phone',$user->phone) }}" class="w-full border rounded p-2" />
                </div>
            </div>
            <div>
                <label class="block text-sm mb-1">Department</label>
                <input name="department" value="{{ old('department',$user->department) }}" class="w-full border rounded p-2" />
            </div>
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
        </form>
    </div>
</div>
@endsection
