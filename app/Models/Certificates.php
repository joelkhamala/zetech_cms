<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificates extends Model
{
    use HasFactory;

    protected $primaryKey = 'certificate_id';

    protected $fillable=[
        'email','certificate_serial_number','file_name','department_id','program_id','issued_by','file_upload'
    ];
}
