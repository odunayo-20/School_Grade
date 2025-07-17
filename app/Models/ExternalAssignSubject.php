<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalAssignSubject extends Model
{
    protected $guarded = [];
    protected $connection = 'mysql2';
    protected $table = 'assign_subjects';


    public function subject(){
        return $this->belongsTo(Subject::class);
     }
     public function class(){
        return $this->belongsTo(StudentClass::class);
     }
}
