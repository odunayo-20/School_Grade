<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalNews extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'news';

    public $guarded = [];
}
