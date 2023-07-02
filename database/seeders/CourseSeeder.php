<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::create([
            'name' => 'Belajar Fundamental Javascript',
            'course_category_id' => 1,
            'description' => 'Belajar membuat website yang interaktif dengan Javascript',
            'thumbnail' => '1798-logo.png',
        ]);
    }
}
