<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $fillable = ['name', 'slug', 'hrm_type'];

    /**
     * Return bool
     */
    public function isEmployee()
    {
        return strtoupper($this->htm_type) == 'EMPLOYEE';
    }
}
