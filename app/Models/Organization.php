<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'logo', 'max_clinics', 'max_employees', 'proda_device_id',
        'owner_id', 'is_hospital', 'appointment_length', 'status',
        'document_letter_header', 'document_letter_footer'
    ];

    /**
     * Return Owner user
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id')->first();
    }

    /**
     * Return Owner user
     */
    public static function combineWithBaseUrl()
    {
        $base_url = url('/');
        $organization_table = (new self())->getTable();

        $select = "*,
            {$organization_table}.id,
            CASE
                WHEN SUBSTRING(logo, 1, 1) = '/'
                    THEN CONCAT('{$base_url}', logo)
                ELSE logo
            END AS logo,
            CASE
                WHEN SUBSTRING(document_letter_header, 1, 1) = '/'
                    THEN CONCAT('{$base_url}', document_letter_header)
                ELSE document_letter_header
            END AS document_letter_header,
            CASE
                WHEN SUBSTRING(document_letter_footer, 1, 1) = '/'
                    THEN CONCAT('{$base_url}', document_letter_footer)
                ELSE document_letter_footer
            END AS document_letter_footer
        ";

        return self::selectRaw($select);
    }
}
