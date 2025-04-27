<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pyschomotor extends Model
{
    /** @use HasFactory<\Database\Factories\PyschomotorFactory> */
    use HasFactory;

    protected $guarded = [];

    public function pyschomotor()
    {
        return $this->hasMany(Pyschomotor::class);
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
