<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'logo',
        'max_clinics',
        'max_employees',
        'prova_device_id',
        'owner_id',
    ];

    /**
     * Return Owner user
     *
     * @return $user
     */
    public function owner()
    {
        $user = User::find($this->owner_id);
        return $user;
    }

    /**
     * Return Prova Device
     *
     * @return $prova_device
     */
    public function prova_device()
    {
        $prova_device = ProvaDevice::find($this->prova_device_id);
        return $prova_device;
    }
}
