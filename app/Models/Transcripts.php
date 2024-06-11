<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transcripts extends Model
{
    use HasFactory;
    protected $primaryKey = 'transcript_id';

    protected $fillable=[
        'email','transcript_serial_number','file_name','department_id','program_id','file_upload','picked'
    ];
}