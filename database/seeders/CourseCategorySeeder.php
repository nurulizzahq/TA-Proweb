<?php

namespace Database\Seeders;

use App\Models\CourseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CourseCategory::create([
            'name' => 'Front End'
        ]);

        CourseCategory::create([
            'name' => 'Back End'
        ]);

        CourseCategory::create([
            'name' => 'Full Stack'
        ]);
    }
}
