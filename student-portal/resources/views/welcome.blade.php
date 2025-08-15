
@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-bold mb-6">Welcome to Student Portal</h1>
@endsection

@section('content')
    <div class="max-w-3xl mx-auto py-10">
        <div class="bg-white shadow rounded-xl p-8">
            <div class="grid sm:grid-cols-2 gap-4">
                <div class="border rounded-lg p-4">
                    <h2 class="font-semibold mb-2">Student</h2>
                    <div class="space-x-2">
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-gray-800 text-white rounded shadow hover:bg-gray-900 transition text-lg font-semibold">Login</a>
                        <a href="{{ route('register') }}?role=student" class="px-4 py-2 bg-green-500 text-black rounded shadow border-2 border-green-700 hover:bg-green-700 hover:text-white transition font-bold">Sign up</a>
                    </div>
                </div>
                <div class="border rounded-lg p-4">
                    <h2 class="font-semibold mb-2">Teacher / Admin</h2>
                    <div class="space-x-2">
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-gray-800 text-white rounded shadow hover:bg-gray-900 transition text-lg font-semibold">Login</a>
                        <a href="{{ route('register') }}?role=teacher" class="px-4 py-2 bg-indigo-500 text-black rounded shadow border-2 border-indigo-700 hover:bg-indigo-700 hover:text-white transition font-bold">Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
