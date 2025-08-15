<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DemoStudentsSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1,5) as $i) {
            User::firstOrCreate(
                ['email' => "student{$i}@example.com"],
                [
                    'name' => "Student {$i}",
                    'password' => Hash::make('password'),
                    'role' => 'student',
                    'student_id' => 'S' . str_pad((string)$i, 4, '0', STR_PAD_LEFT),
                    'department' => 'CSE',
                ]
            );
        }
    }
}
