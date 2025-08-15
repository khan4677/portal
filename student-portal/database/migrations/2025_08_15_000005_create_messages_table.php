<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('replied_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('subject');
            $table->text('body');
            $table->text('reply_body')->nullable();
            $table->string('status')->default('open');
            $table->timestamp('replied_at')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
