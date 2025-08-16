@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-100 flex items-center justify-center px-6 py-12">

    <div class="max-w-4xl w-full">

        {{-- Card --}}
        <div class="bg-white rounded-3xl shadow-xl p-12 text-center hover:shadow-2xl transition transform hover:-translate-y-2">

            {{-- Icon --}}
            <div class="flex items-center justify-center w-28 h-28 bg-blue-100 text-blue-700 rounded-full mx-auto text-6xl mb-6">
                🎓
            </div>

            {{-- Title --}}
            <h1 class="text-5xl font-extrabold text-gray-900 mb-4">
                Welcome to <span class="text-blue-600">Student Portal</span>
            </h1>

            {{-- Description --}}
            <p class="text-lg text-gray-600 mb-10 max-w-2xl mx-auto">
                A smart platform to connect students, teachers, and administrators seamlessly.
                Manage your studies, track progress, and stay organized — all in one place.
            </p>

            {{-- Buttons --}}
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="{{ route('login') }}" 
                   class="px-8 py-4 bg-blue-600 text-white text-lg font-semibold rounded-xl shadow hover:bg-blue-700 transition transform hover:-translate-y-1">
                    Login
                </a>
                <a href="{{ route('register') }}" 
                   class="px-8 py-4 bg-blue-50 border border-blue-600 text-blue-600 text-lg font-semibold rounded-xl hover:bg-blue-100 transition transform hover:-translate-y-1">
                    Sign Up
                </a>
            </div>
        </div>

        {{-- Footer --}}
        <p class="mt-12 text-sm text-gray-500 text-center">
            &copy; {{ date('Y') }} Student Portal. All rights reserved.
        </p>
    </div>
</div>
@endsection
