<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function results()
{
    return $this->hasMany(Result::class);
}

public function students(){
    return $this->hasMany(Student::class);
}

public function classes()
{
    return $this->belongsToMany(StudentClass::class, 'assign_subjects', 'subject_id', 'class_id');
}




}
