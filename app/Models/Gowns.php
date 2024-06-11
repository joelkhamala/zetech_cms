<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gowns extends Model
{
    use HasFactory;
    protected $primaryKey = 'gown_id';

    protected $fillable = [
        'email',
        'gown_serial_number',
        'condition',
        'size',
    ];
}
