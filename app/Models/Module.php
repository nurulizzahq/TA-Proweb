<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use Sluggable;
    use HasFactory;

    protected $guarded = ["id", "created_at", "updated_at"];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function learnedModule()
    {
        return $this->belongsTo(ModuleLearned::class);
    }

    public function moduleLearned()
    {
        return $this->hasMany(ModuleLearned::class);
    }

    public function sluggable(): array
    {
        return [
            "slug" => [
                "source" => "title",
            ],
        ];
    }
}
