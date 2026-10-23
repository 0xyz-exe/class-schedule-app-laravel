<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Schedule::create([
            'course_code' => 'CS101',
            'course_name' => 'Introduction to Programming',
            'instructor' => 'Dr. Smith',
            'room' => 'A201',
            'day' => 'Monday',
            'start_time' => '08:00',
            'end_time' => '10:00',
            'semester' => 'Fall 2024',
            'credits' => 3,
        ]);

        Schedule::create([
            'course_code' => 'MATH201',
            'course_name' => 'Calculus II',
            'instructor' => 'Prof. Johnson',
            'room' => 'B305',
            'day' => 'Monday',
            'start_time' => '10:30',
            'end_time' => '12:30',
            'semester' => 'Fall 2024',
            'credits' => 4,
        ]);

        Schedule::create([
            'course_code' => 'ENG102',
            'course_name' => 'English Composition',
            'instructor' => 'Dr. Williams',
            'room' => 'C102',
            'day' => 'Tuesday',
            'start_time' => '09:00',
            'end_time' => '11:00',
            'semester' => 'Fall 2024',
            'credits' => 3,
        ]);

        Schedule::create([
            'course_code' => 'PHY201',
            'course_name' => 'Physics I',
            'instructor' => 'Dr. Brown',
            'room' => 'D401',
            'day' => 'Tuesday',
            'start_time' => '13:00',
            'end_time' => '15:00',
            'semester' => 'Fall 2024',
            'credits' => 4,
        ]);

        Schedule::create([
            'course_code' => 'CS201',
            'course_name' => 'Data Structures',
            'instructor' => 'Dr. Davis',
            'room' => 'A203',
            'day' => 'Wednesday',
            'start_time' => '08:00',
            'end_time' => '10:00',
            'semester' => 'Fall 2024',
            'credits' => 3,
        ]);

        Schedule::create([
            'course_code' => 'HIST101',
            'course_name' => 'World History',
            'instructor' => 'Prof. Miller',
            'room' => 'E101',
            'day' => 'Thursday',
            'start_time' => '11:00',
            'end_time' => '13:00',
            'semester' => 'Fall 2024',
            'credits' => 3,
        ]);

        Schedule::create([
            'course_code' => 'CS301',
            'course_name' => 'Database Systems',
            'instructor' => 'Dr. Wilson',
            'room' => 'A301',
            'day' => 'Friday',
            'start_time' => '14:00',
            'end_time' => '16:00',
            'semester' => 'Fall 2024',
            'credits' => 3,
        ]);
    }
}
