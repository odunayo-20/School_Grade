<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];


    public function student()
{
    return $this->belongsTo(Student::class);
}

public function subject()
{
    return $this->belongsTo(Subject::class);
}

public function results()
{
    return $this->hasMany(Result::class);
}

public function class(){
    return $this->belongsTo(StudentClass::class, 'class_id');
}
public function session(){
    return $this->belongsTo(SchoolSession::class, 'schoolSession_id');
}
public function semester(){
    return $this->belongsTo(Semester::class);
}

}
