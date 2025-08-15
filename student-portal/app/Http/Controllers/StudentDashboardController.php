<?php
namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Message;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $assignments = Assignment::latest()->paginate(10);
        $results = auth()->user()->results()->latest()->paginate(10);
        $submissions = auth()->user()->submissions()->with('assignment')->latest()->paginate(10);
        return view('student.dashboard', compact('assignments','results','submissions'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('student.profile', compact('user'));
    }

    public function profileUpdate(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:50',
            'department' => 'nullable|string|max:100',
        ]);
        $request->user()->update($data);
        return back()->with('status', 'Profile updated!');
    }

    public function messageStore(Request $request)
    {
        $data = $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        \App\Models\Message::create([
            'from_user_id' => $request->user()->id,
            'subject' => $data['subject'],
            'body' => $data['body'],
        ]);
        return back()->with('status','Message sent!');
    }
}
