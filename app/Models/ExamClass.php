<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamClass extends Model
{
    use HasFactory;

    protected $guarded = ["id", "created_at", "updated_at"];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function multipleChoise()
    {
        return $this->hasMany(MultipleChoise::class);
    }

    public function examResults()
    {
        return $this->hasMany(ExamResults::class);
    }
}
