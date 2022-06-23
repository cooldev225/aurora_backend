<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;
    protected $fillable = [
        'organization_id',
        'name',
        'email',
        'phone_number',
        'fax_number',
        'hospital_provider_number',
        'VAED_number',
        'address',
        'street',
        'city',
        'state',
        'postcode',
        'country',
        'latitude',
        'longitude',
        'timezone',
        'specimen_collection_point_number',
        'footnote_signature',
        'default_start_time',
        'default_end_time',
        'default_meal_time',
        'latest_invoice_no',
        'latest_invoice_pathology_no',
        'centre_serial_no',
        'centre_last_invoice_serial_no',
        'lspn_id',
    ];

    /**
     * Return Prova Device
     */
    public function prova_device()
    {
        return $this->hasOne(ProvaDevice::class)->first();
    }
}
