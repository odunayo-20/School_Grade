<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PastQuestion extends Model
{
    public $guarded = [];


    public function class(){
        return $this->belongsTo(StudentClass::class, 'class_id');
    }
    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    public function term(){
        return $this->belongsTo(Semester::class, 'term_id');
    }
    public function session(){
        return $this->belongsTo(SchoolSession::class, 'session_id');
    }
}
