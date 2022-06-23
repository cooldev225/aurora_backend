<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'username',
        'email',
        'first_name',
        'last_name',
        'password',
        'role_id',
        'organization_id',
        'clinic_id',
        'date_of_birth',
        'mobile_number',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Return User Role
     */
    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role_id')->first();
    }

    /**
     * Return Organization
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class)->first();
    }

    /**
     * Return Organization
     */
    public function isAdmin()
    {
        return $this->role()->slug == 'admin';
    }

    /**
     * Return Current Clinic
     */
    public function currentClinic()
    {
        $this->setCurrentClinic();

        return $this->belongsTo(Clinic::class)->first();
    }

    /**
     * Set Current Clinic
     */
    public function setCurrentClinic()
    {
        if ($this->clinic_id == 0) {
            $clinic = Clinic::where(
                'organization_id',
                $this->organization_id
            )->first();

            if (!empty($clinic->toArray())) {
                $this->clinic_id = $clinic->id;
                $this->save();
            }
        }
    }
}
