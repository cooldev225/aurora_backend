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
        'proda_device_id',
        'owner_id',
        'is_hospital',
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
        $select = "*,
            CASE
            WHEN SUBSTRING(logo, 1, 1) = '/'
                THEN CONCAT('{$base_url}', logo)
            ELSE logo
            END AS logo";

        return self::selectRaw($select);
    }
}
