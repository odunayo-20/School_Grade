<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    /** @use HasFactory<\Database\Factories\StudentClassFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $connection = 'mysql2';
    protected $table = 'classes';

    public function class(){
        return $this->hasMany(StudentClass::class, 'class_id');
    }

    public function subjects()
{
    return $this->belongsToMany(Subject::class, 'assign_subjects', 'class_id', 'subject_id');
}

}


