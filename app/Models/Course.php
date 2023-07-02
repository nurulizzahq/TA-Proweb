<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use Sluggable;
    use HasFactory;

    protected $guarded = ["id", "created_at", "updated_at"];

    public function category(): BelongsTo
    {
        return $this->belongsTo(CourseCategory::class, "course_category_id");
    }

    public function module(): HasMany
    {
        return $this->hasMany(Module::class);
    }

    public function courseLearned()
    {
        return $this->hasMany(CourseLearned::class);
    }

    public function exam()
    {
        return $this->hasMany(ExamClass::class);
    }

    public function examResults()
    {
        return $this->hasMany(ExamResult::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function sluggable(): array
    {
        return [
            "slug" => [
                "source" => "name",
            ],
        ];
    }
}
