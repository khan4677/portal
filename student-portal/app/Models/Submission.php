<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;
    protected $fillable = [
        'assignment_id','student_id','file_path','message','status','grade','feedback','graded_by','graded_at'
    ];

    protected $casts = ['graded_at' => 'datetime'];

    public function assignment() { return $this->belongsTo(Assignment::class); }
    public function student() { return $this->belongsTo(User::class, 'student_id'); }
    public function grader() { return $this->belongsTo(User::class, 'graded_by'); }
}
