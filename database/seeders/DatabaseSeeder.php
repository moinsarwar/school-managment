<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Office;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Exam;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // --- Admins ---
        Admin::create(['name' => 'Admin User', 'email' => 'admin@test.com', 'password' => Hash::make('password')]);

        // --- Office Staff ---
        Office::create(['name' => 'Office Staff', 'email' => 'office@test.com', 'password' => Hash::make('password')]);

        // --- Classes ---
        $classes = [];
        foreach (['Class 1', 'Class 2', 'Class 3', 'Class 4', 'Class 5', 'Class 6', 'Class 7', 'Class 8', 'Class 9', 'Class 10'] as $name) {
            $classes[] = SchoolClass::create(['name' => $name]);
        }

        // --- Sections ---
        $sections = [];
        foreach ($classes as $class) {
            $sections[$class->id] = [];
            foreach (['A', 'B'] as $sName) {
                $sections[$class->id][] = Section::create(['name' => $sName, 'class_id' => $class->id]);
            }
        }

        // --- Subjects ---
        $subjectNames = ['Mathematics', 'English', 'Science', 'Urdu', 'Islamiat', 'Computer Science'];
        $subjects = [];
        foreach ($classes as $class) {
            foreach ($subjectNames as $sName) {
                $subjects[] = Subject::create(['name' => $sName, 'class_id' => $class->id]);
            }
        }

        // --- Exams ---
        foreach ($classes as $class) {
            Exam::create(['name' => 'Midterm Exam', 'class_id' => $class->id, 'date' => '2026-04-15']);
            Exam::create(['name' => 'Final Exam', 'class_id' => $class->id, 'date' => '2026-07-10']);
        }

        // --- Teachers (one per class) ---
        $teacherNames = ['Ali Khan', 'Fatima Noor', 'Ahmed Raza', 'Sara Malik', 'Zain Ul Abideen', 'Ayesha Siddiqui', 'Bilal Hassan', 'Hina Shahid', 'Omar Farooq', 'Nadia Jameel'];
        foreach ($classes as $i => $class) {
            $firstSubject = Subject::where('class_id', $class->id)->first();
            Teacher::create([
                'name' => $teacherNames[$i],
                'email' => 'teacher' . ($i + 1) . '@test.com',
                'password' => Hash::make('password'),
                'phone' => '0300-' . rand(1000000, 9999999),
                'qualification' => ['M.Ed', 'B.Ed', 'M.A', 'M.Sc', 'B.Sc'][array_rand(['M.Ed', 'B.Ed', 'M.A', 'M.Sc', 'B.Sc'])],
                'class_id' => $class->id,
                'subject_id' => $firstSubject?->id,
            ]);
        }

        // --- Students (5 per class, section A) ---
        $studentFirstNames = ['Hassan', 'Amina', 'Usman', 'Zara', 'Hamza', 'Maryam', 'Saad', 'Khadija', 'Faisal', 'Rabia'];
        $studentCount = 1;
        foreach ($classes as $class) {
            $sectionA = $sections[$class->id][0] ?? null;
            for ($j = 0; $j < 5; $j++) {
                Student::create([
                    'name' => $studentFirstNames[($j + $class->id) % 10] . ' ' . ['Ahmad', 'Ali', 'Khan', 'Butt', 'Sheikh'][$j],
                    'email' => 'student' . $studentCount . '@test.com',
                    'password' => Hash::make('password'),
                    'father_name' => 'Mr. ' . ['Imran', 'Kamran', 'Tariq', 'Zahid', 'Kashif'][$j],
                    'date_of_birth' => now()->subYears(rand(6, 16))->subDays(rand(0, 365))->format('Y-m-d'),
                    'gender' => $j % 2 == 0 ? 'male' : 'female',
                    'phone' => '0321-' . rand(1000000, 9999999),
                    'class_id' => $class->id,
                    'section_id' => $sectionA?->id,
                    'roll_number' => $class->name . '-' . str_pad($j + 1, 3, '0', STR_PAD_LEFT),
                    'admission_date' => now()->subMonths(rand(1, 24))->format('Y-m-d'),
                ]);
                $studentCount++;
            }
        }
    }
}
