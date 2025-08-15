<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['from_user_id','replied_by','subject','body','reply_body','status','replied_at'];

    protected $casts = ['replied_at' => 'datetime'];

    public function sender() { return $this->belongsTo(User::class, 'from_user_id'); }
    public function replier() { return $this->belongsTo(User::class, 'replied_by'); }
}
