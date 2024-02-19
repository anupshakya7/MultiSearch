<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyLevel extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function course()
    {
        return $this->hasMany(Course::class, 'level_id', 'id');
    }
}
