<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    /** @use HasFactory<\Database\Factories\StudentClassFactory> */
    use HasFactory;

    protected $guarded = [];


    public function class(){
        return $this->hasMany(StudentClass::class, 'class_id');
    }
}


