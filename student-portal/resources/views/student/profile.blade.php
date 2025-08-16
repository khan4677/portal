@extends('layouts.app')
@section('content')
<div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

    <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white rounded-2xl shadow-lg p-6 mb-8">
        <h1 class="text-3xl font-extrabold">Edit Profile</h1>
        <p class="mt-2 text-indigo-100">Update your details and stay connected with your courses.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-lg p-8 space-y-6">

        @if(session('status'))
            <div class="p-3 mb-4 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('student.profile.update') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Name</label>
                <input name="name" value="{{ old('name',$user->name) }}" class="w-full border-2 border-indigo-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition" required />
                @error('name')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
            </div>

            <!-- Student ID & Phone -->
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Student ID</label>
                    <input name="student_id" value="{{ old('student_id',$user->student_id) }}" class="w-full border-2 border-purple-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition" />
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Phone</label>
                    <input name="phone" value="{{ old('phone',$user->phone) }}" class="w-full border-2 border-pink-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition" />
                </div>
            </div>

            <!-- Department -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Department</label>
                <input name="department" value="{{ old('department',$user->department) }}" class="w-full border-2 border-indigo-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition" />
            </div>

            <!-- Save Button -->
            <button class="w-full px-6 py-3 bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 text-white font-semibold rounded-lg hover:scale-105 transform transition shadow-lg">
                Save Changes
            </button>
        </form>
    </div>
</div>
@endsection
