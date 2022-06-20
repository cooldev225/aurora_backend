<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthFund extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code', 'fund', 'contact', 'issues'];
}
