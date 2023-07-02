<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = ["id", "created_at", "updated_at"];

    public function StudentAssignment()
    {
        return $this->hasMany(StudentAssignment::class);
    }

    public function assigment()
    {
        return $this->hasOne(Assigment::class);
    }
}
