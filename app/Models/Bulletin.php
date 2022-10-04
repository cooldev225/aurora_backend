<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    use HasFactory;

    protected $fillable = ['title','created_by','organization_id','included_roles','body','expiry_date'];

    protected $appends = [
        'created_by_name'
    ];

    
    public function getCreatedByNameAttribute()
    {
        return User::find($this->created_by)->full_name;  
    }

}
