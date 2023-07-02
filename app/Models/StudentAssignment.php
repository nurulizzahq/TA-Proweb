<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAssignment extends Model
{
    use HasFactory;

    protected $guarded = ["id", "created_at", "updated_at"];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function assigment()
    {
        return $this->hasOne(Assigment::class);
    }
}
