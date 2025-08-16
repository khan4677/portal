<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    // Teacher: View all submissions for an assignment
    public function index(Assignment $assignment)
    {
        $user = Auth::user();
        if (!$user || !$user->isTeacher()) {
            abort(403, 'Unauthorized action.');
        }

        $submissions = $assignment->submissions()->with('student')->latest()->paginate(15);

        return view('submissions.index', compact('assignment', 'submissions'));
    }

    // Student: View own submissions
    public function showStudentSubmissions(Assignment $assignment)
    {
        $user = Auth::user();
        if (!$user || !$user->isSudent()) {
            abort(403, 'Unauthorized action.');
        }

        $submissions = $assignment->submissions()
            ->where('student_id', $user->id)
            ->latest()
            ->paginate(15);

        return view('submissions.show', compact('assignment', 'submissions'));
    }

    // Store submission (student)
    public function store(Request $request, Assignment $assignment)
    {
        $user = Auth::user();
        if (!$user || !$user->isStudent()) {
            abort(403, 'Unauthorized action.');
        }

        $data = $request->validate([
            'message' => 'nullable|string',
            'file' => 'nullable|file|max:30720', // 30MB
        ]);

        $path = $request->hasFile('file') ? $request->file('file')->store('submissions', 'public') : null;

        Submission::create([
            'assignment_id' => $assignment->id,
            'student_id' => $user->id,
            'file_path' => $path,
            'message' => $data['message'] ?? null,
            'status' => 'submitted',
        ]);

        return back()->with('status', 'Submission uploaded successfully!');
    }
}
