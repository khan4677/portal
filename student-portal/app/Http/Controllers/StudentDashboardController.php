<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    /**
     * Show the student dashboard with assignments, submissions, and results.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $assignments = Assignment::latest()->paginate(10);
        $results = $user->results()->latest()->paginate(10);
        $submissions = $user->submissions()->with('assignment')->latest()->paginate(10);

        return view('student.dashboard', compact('assignments', 'results', 'submissions'));
    }

    /**
     * Show the student profile page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function profile()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        return view('student.profile', compact('user'));
    }

    /**
     * Update the student profile information.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function profileUpdate(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'student_id' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:50',
            'department' => 'nullable|string|max:100',
        ]);

        $user->update($data);

        return back()->with('status', 'Profile updated!');
    }

    /**
     * Store a message sent by the student to admin/teacher.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function messageStore(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $data = $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Message::create([
            'from_user_id' => $user->id,
            'subject' => $data['subject'],
            'body' => $data['body'],
        ]);

        return back()->with('status', 'Message sent!');
    }
}
