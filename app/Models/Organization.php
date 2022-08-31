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

    protected $appends = array('user_count', 'clinic_count', 'is_max_users', 'is_max_clinics');

   /**
     * Returns the total user count
     */
    public function getUserCountAttribute()
    {
        return $this->users()->count(); 
    }

    /**
     * Returns the total clinic count
     */
    public function getClinicCountAttribute()
    {
        return $this->clinics()->count();  
    }

    /**
     * Returns true if max users reached
     */
    public function getIsMaxUsersAttribute()
    {
        if($this->user_count >= $this->max_employees){
            return true;
        }
        return false;  
    }

    /**
     * Returns true of max clinics reached
     */
    public function getIsMaxClinicsAttribute()
    {
        if($this->clinic_count >= $this->max_clinics){
            return true;
        }
        return false;  
    }

        /**
     * Get the clinics for organization.
     */
    public function clinics()
    {
        return $this->hasMany(Clinic::class);
    }

        /**
     * Get the patients for organization.
     */
    public function patients()
    {
        return $this->belongsToMany(Patient::class)->with('upcomingAppointments');
    }

    /**
     * Get the users for organization.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

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
