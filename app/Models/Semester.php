<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    /** @use HasFactory<\Database\Factories\SemesterFactory> */
    use HasFactory;


    // protected $fillable = ['name', 'start_date', 'end_date'];

    protected $guarded = [];

    public function semester(){
        return $this->hasMany(Semester::class);
    }
}
