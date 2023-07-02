<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseCategory extends Model
{
    use HasFactory;

    protected $guarded = ["id", "created_at", "updated_at"];

    public function course(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
