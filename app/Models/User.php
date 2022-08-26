<?php

namespace App\Models;

use App\Mail\Notification;
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
        'date_of_birth',
        'mobile_number',
        'address',
    ];

    protected $appends = array('role');

    public function getRoleAttribute()
    {
        return $this->role()->name;
    }

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
        return $this->belongsTo(UserRole::class)->first();
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
     * Return Employee
     */
    public function employee() {
        return $this->hasOne(Employee::class);
    }

    public static function create(array $attributes = []) {
        $user = static::query()->create($attributes);

        $organization_id = auth()->user()->organization_id;
        $password = isset($attributes['raw_password']) ? $attributes['raw_password'] : '';
        $data = array(
            'organization_id'   =>  $organization_id,
            'password'          =>  $password
        );
       //Notification::sendUserNotification($data, $user, 'user_created');

        return $user;
    }
    
    /**
     * translate template
     */
    public function translate($template, $data)
    {
        $words = [
            '[first_name]' => $this->first_name,
            '[app_link]'  => env('APP_URL'),
            '[username]'  => $this->username,
            '[password]'  => $data['password'],
        ];

        $translated = $template;

        foreach ($words as $key => $word) {
            $translated = str_replace($key, $word, $translated);
        }

        return $translated;
    }
}
