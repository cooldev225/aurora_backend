<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'logo', 'max_clinics', 'max_employees',
        'owner_id', 'is_hospital', 'appointment_length', 'start_time', 'end_time','status',
        'document_letter_header', 'document_letter_footer', 'code', 'has_billing', 'has_coding',
    ];

    protected $appends = [
        'user_count',
        'clinic_count',
        'is_max_users',
        'is_max_clinics',
        'logo_url',
        'document_letter_header_url',
        'document_letter_footer_url',
    ];

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
     * Returns temporary URL for logo file
     */
    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            $expiry = config('temporary_url_expiry');
            return Storage::temporaryUrl($this->logo, now()->addMinutes($expiry));
        }
    }

    /**
     * Returns temporary URL for header file
     */
    public function getDocumentLetterHeaderUrlAttribute()
    {
        if ($this->document_letter_header) {
            $expiry = config('temporary_url_expiry');
            return Storage::temporaryUrl($this->document_letter_header, now()->addMinutes($expiry));
        }
    }

    /**
     * Returns temporary URL for footer file
     */
    public function getDocumentLetterFooterUrlAttribute()
    {
        if ($this->document_letter_footer) {
            $expiry = config('temporary_url_expiry');
            return Storage::temporaryUrl($this->document_letter_footer, now()->addMinutes($expiry));
        }
    }

    /**
     * Get the clinics for organization.
     */
    public function clinics()
    {
        return $this->hasMany(Clinic::class);
    }

        /**
     * Get the bulletins for organization.
     */
    public function bulletins()
    {
        return $this->hasMany(Bulletin::class);
    }


    /**
     * Get the appointment types for organization.
     */
    public function appointment_Types()
    {
        return $this->hasMany(AppointmentType::class);
    }

    /**
     * Get the notification templates for organization.
     */
    public function notificationTemplates()
    {
        return $this->hasMany(NotificationTemplate::class);
    }



        /**
     * Get the patients for organization.
     */
    public function patients()
    {
        return $this->belongsToMany(Patient::class)->with('upcoming_appointments');
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
        return $this->belongsTo(User::class, 'owner_id');
    }


        /**
     * Return Schedule Timeslots
     */
    public function scheduleTimeslots()
    {
        return $this->hasMany(HrmScheduleTimeslot::class);
    }

    public function hrmWeeklySchedule()
    {
        return $this->hasMany(HrmWeeklySchedule::class);
    }

}
