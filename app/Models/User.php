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
     *
     * @return $current_role
     */
    public function role()
    {
        $current_role = UserRole::find($this->role_id);
        return $current_role;
    }

    /**
     * Return Organization
     *
     * @return $organization
     */
    public function organization()
    {
        $organization = Organization::find($this->organization_id);
        return $organization;
    }
}
