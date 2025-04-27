<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resumption extends Model
{
    /** @use HasFactory<\Database\Factories\ResumptionFactory> */
    use HasFactory;

    protected $guarded = [];



public function semester(){
    return $this->belongsTo(Semester::class);
}
public function session(){
    return $this->belongsTo(SchoolSession::class, 'schoolsession_id');
}


}
