<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalInformation extends Model
{
    protected $table = 'additional_information';
    protected $casts = ['data' => 'array'];
}
