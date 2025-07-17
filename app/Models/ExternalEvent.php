<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalEvent extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'events';

    public $guarded = [];
}
