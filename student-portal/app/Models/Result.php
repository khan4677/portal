<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $fillable = ['student_id','subject','marks','grade','term','published_at','uploaded_by'];

    protected $casts = ['published_at' => 'datetime'];

    public function student() { return $this->belongsTo(User::class, 'student_id'); }
    public function uploader() { return $this->belongsTo(User::class, 'uploaded_by'); }
}
