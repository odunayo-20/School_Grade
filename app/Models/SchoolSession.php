<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolSession extends Model
{
    /** @use HasFactory<\Database\Factories\SchoolSessionFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $connection = 'mysql';
protected $table = 'school_sessions';


    public function session(){
        return $this->hasMany(SchoolSession::class);
    }
}
