<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TotalAttendance extends Model
{
    public $guarded = [];

    public function semester(){
        return $this->belongsTo(Semester::class, 'semester_id');
    }
    public function session(){
        return $this->belongsTo(SchoolSession::class, 'schoolsession_id');
    }
}
