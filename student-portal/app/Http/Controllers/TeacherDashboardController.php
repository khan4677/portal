<?php
namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Message;
use App\Models\User;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $students = User::where('role','student')->latest()->paginate(8);
        $assignments = Assignment::withCount('submissions')->latest()->paginate(8);
        $messages = Message::latest()->paginate(8);
        return view('teacher.dashboard', compact('students','assignments','messages'));
    }
}
