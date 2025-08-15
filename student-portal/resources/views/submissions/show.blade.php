@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Submission Details</h2>
    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Assignment ID:</strong> {{ $submission->assignment_id }}</p>
            <p><strong>Student ID:</strong> {{ $submission->student_id }}</p>
            <p><strong>Status:</strong> {{ $submission->status }}</p>
            <p><strong>Message:</strong> {{ $submission->message ?? 'N/A' }}</p>
            <p><strong>File:</strong>
                @if($submission->file_path)
                    <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank">Download</a>
                @else
                    No file submitted
                @endif
            </p>
            <p><strong>Grade:</strong> {{ $submission->grade ?? 'Not graded' }}</p>
            <p><strong>Feedback:</strong> {{ $submission->feedback ?? 'N/A' }}</p>
        </div>
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
</div>
@endsection
