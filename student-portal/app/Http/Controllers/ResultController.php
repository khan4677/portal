<?php
namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function studentIndex()
    {
        $results = auth()->user()->results()->latest()->paginate(20);
        return view('results.student_index', compact('results'));
    }

    public function create()
    {
        $students = User::where('role','student')->orderBy('name')->get();
        return view('results.create', compact('students'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'marks' => 'nullable|numeric|min:0|max:100',
            'grade' => 'nullable|string|max:5',
            'term' => 'nullable|string|max:50',
        ]);

        Result::create([
            'student_id' => $data['student_id'],
            'subject' => $data['subject'],
            'marks' => $data['marks'] ?? null,
            'grade' => $data['grade'] ?? null,
            'term' => $data['term'] ?? null,
            'published_at' => now(),
            'uploaded_by' => $request->user()->id,
        ]);

        return redirect()->route('teacher.dashboard')->with('status','Result published');
    }
}
