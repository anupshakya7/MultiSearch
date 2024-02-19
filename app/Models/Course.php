<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function institute()
    {
        return $this->belongsToMany(Institute::class);
    }

    public function level()
    {
        return $this->belongsTo(Course::class);
    }
}
