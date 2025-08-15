<?php
namespace App\Policies;

use App\Models\Submission;
use App\Models\User;

class SubmissionPolicy
{
    /**
     * Determine if the given submission can be viewed by the user.
     */
    public function view(User $user, Submission $submission)
    {
        // Allow students to view their own submissions, and teachers to view any
        return $user->id === $submission->student_id || $user->role === 'teacher';
    }
}
