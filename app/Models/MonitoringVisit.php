<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringVisit extends Model
{
    use HasFactory;

    protected $table = 'monitoring_visits';

    protected $casts = ['data' => 'array'];
}
