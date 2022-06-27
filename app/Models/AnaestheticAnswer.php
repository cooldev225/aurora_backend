<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnaestheticAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['appointment_id', 'question_id', 'answer'];
}
