<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierContract extends Model
{
    use HasFactory;

    protected $table = 'supplier_contracts';

    protected $casts = [
        'file_attachments_gi' => 'array',

    ];
}
