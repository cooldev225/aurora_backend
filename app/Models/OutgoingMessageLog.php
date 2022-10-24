<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingMessageLog extends Model
{
    use HasFactory;

    protected $fillable = ['send_method','sending_doctor_name','sending_doctor_provider','receiving_doctor_name','receiving_doctor_provider'];

}
