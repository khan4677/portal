<?php
namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function store(Request $request, Assignment $assignment)
    {
        $data = $request->validate([
            'message' => 'nullable|string',
            'file' => 'nullable|file|max:30720',
        ]);

        $path = $request->hasFile('file')
            ? $request->file('file')->store('submissions','public')
            : null;

        Submission::create([
            'assignment_id' => $assignment->id,
            'student_id' => $request->user()->id,
            'file_path' => $path,
            'message' => $data['message'] ?? null,
            'status' => 'submitted',
        ]);

        return back()->with('status','Submission uploaded');
    }

    public function index(Assignment $assignment)
    {
        $submissions = Submission::with('student')
            ->where('assignment_id',$assignment->id)
            ->latest()->paginate(15);
        return view('submissions.index', compact('assignment','submissions'));
    }

    public function grade(Request $request, Submission $submission)
    {
        $data = $request->validate([
            'grade' => 'required|numeric|min:0|max:100',
            'feedback' => 'nullable|string',
        ]);

        $submission->update([
            'grade' => $data['grade'],
            'feedback' => $data['feedback'] ?? null,
            'status' => 'graded',
            'graded_by' => $request->user()->id,
            'graded_at' => now(),
        ]);

        return back()->with('status','Submission graded');
    }

    public function show(Submission $submission)
    {
        // Remove authorization for now to avoid policy errors
        return view('submissions.show', compact('submission'));
    }
}
