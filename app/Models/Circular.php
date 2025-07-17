<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Circular extends Model
{
    public $guarded = [];

    public function subject(){
        return $this->belongsTo(Subject::class);
     }
     public function class(){
        return $this->belongsTo(StudentClass::class);
     }

     public function semester(){
        return $this->belongsTo(Semester::class, 'semester_id');
    }
     public function session(){
        return $this->belongsTo(SchoolSession::class, 'schoolsession_id');
    }

}
