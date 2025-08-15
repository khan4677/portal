<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name','email','password','role','student_id','phone','department'
    ];

    protected $hidden = ['password','remember_token'];

    protected $casts = ['email_verified_at' => 'datetime','password' => 'hashed'];

    public function isStudent(): bool { return $this->role === 'student'; }
    public function isTeacher(): bool { return $this->role === 'teacher'; }

    public function assignmentsCreated() { return $this->hasMany(Assignment::class, 'created_by'); }
    public function submissions() { return $this->hasMany(Submission::class, 'student_id'); }
    public function results() { return $this->hasMany(Result::class, 'student_id'); }
    public function messages() { return $this->hasMany(Message::class, 'from_user_id'); }
}
