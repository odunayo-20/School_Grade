<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{

    protected $guarded = [];

public function result()
{
    return $this->hasMany(Result::class);
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
