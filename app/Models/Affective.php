<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affective extends Model
{
    /** @use HasFactory<\Database\Factories\AffectiveFactory> */
    use HasFactory;

    protected $guarded = [];

    public function affective()
    {
        return $this->hasMany(Affective::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function semester(){
        return $this->belongsTo(Semester::class);
    }
}
