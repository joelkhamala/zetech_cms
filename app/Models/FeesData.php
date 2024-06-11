<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesData extends Model
{
    use HasFactory;

    protected $primaryKey = 'fee_id';

    protected $fillable = ['email','amount','reason','bank','code','gown_fees','school_fees'];
}
