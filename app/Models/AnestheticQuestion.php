<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnestheticQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['organization_id', 'question', 'status'];
}