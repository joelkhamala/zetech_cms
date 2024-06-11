<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    use HasFactory;
    protected $primaryKey = 'finance_id';

    protected $fillable = [
        'email',
        'department_id',
        'program_id',
        'officer_id',
        'gown_fees',
        'school_fees',
    ];
}
