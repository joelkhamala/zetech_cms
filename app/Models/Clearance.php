<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clearance extends Model
{
    use HasFactory;

    protected $fillable =[
        'email',
        'department_id',
        'program_id',
        'library',
        'finance',
        'gown',
        'certTrans',
    ];
}
