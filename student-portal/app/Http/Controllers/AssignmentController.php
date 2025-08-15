<?php
namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with('creator')->latest()->paginate(12);
        return view('assignments.index', compact('assignments'));
    }

    public function create()
    {
        return view('assignments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'attachment' => 'nullable|file|max:20480',
        ]);

        $path = $request->hasFile('attachment')
            ? $request->file('attachment')->store('assignments','public')
            : null;

        Assignment::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'due_date' => $data['due_date'] ?? null,
            'attachment_path' => $path,
            'created_by' => $request->user()->id,
        ]);

        return redirect()->route('assignments.index')->with('status','Assignment created');
    }

    public function show(Assignment $assignment)
    {
        return view('assignments.show', compact('assignment'));
    }

    public function edit(Assignment $assignment)
    {
        return view('assignments.edit', compact('assignment'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'attachment' => 'nullable|file|max:20480',
        ]);

        if ($request->hasFile('attachment')) {
            if ($assignment->attachment_path) {
                Storage::disk('public')->delete($assignment->attachment_path);
            }
            $assignment->attachment_path = $request->file('attachment')->store('assignments','public');
        }

        $assignment->update([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'due_date' => $data['due_date'] ?? null,
        ]);

        return redirect()->route('assignments.index')->with('status','Assignment updated');
    }

    public function destroy(Assignment $assignment)
    {
        if ($assignment->attachment_path) {
            Storage::disk('public')->delete($assignment->attachment_path);
        }
        $assignment->delete();
        return back()->with('status','Assignment deleted');
    }
}
