<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingMessageLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'patient_id',
        'message_contents',
        'sending_user',
        'sending_doctor_user',
        'send_method',
        'send_status',
        'sending_doctor_name',
        'sending_doctor_provider',
        'receiving_doctor_name',
        'receiving_doctor_provider'
    ];

    protected $appends = [
        'sending_user_role',
        'sending_user_name',
        'sending_doctor_user_role'
    ];

    /**
     * Return Patient that the outgoing belongs to
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function sendingUser()
    {
        return $this->hasOne(User::class, 'id','sending_user');
    }

    public function sendingDoctorUser()
    {
        return $this->hasOne(User::class, 'id','sending_doctor_user');
    }

    public function getSendingUserRoleAttribute() {
        $user = $this->sendingUser;
        return $user->role_id;
    }

    public function getSendingUserNameAttribute() {
        $user = $this->sendingUser;
        return $user->full_name;
    }

    public function getSendingDoctorUserRoleAttribute() {
        $user = $this->sendingDoctorUser;
        return $user->role_id;
    }
}
