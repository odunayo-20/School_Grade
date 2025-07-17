<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalStaff extends Model
{
    protected $connection = 'mysql2';  // Make sure this connection exists
    protected $table = 'staff';        // Explicit table name
    protected $guarded = [];

    // Add timestamps if your table has created_at/updated_at
    public $timestamps = true;

    // Define relationships
    public function timetables()
    {
        return $this->hasMany(Timetable::class);
    }
    public function staff()
    {
        return $this->belongsTo(ExternalStaff::class, 'staff_id');
    }

}
