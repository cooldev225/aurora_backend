<?php

namespace App\Models;

use App\Mail\Notification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
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

    protected $appends = array('role_name', 'full_name');

    public function getRoleNameAttribute()
    {
        return $this->role->name;
    }


    public function getFullNameAttribute()
    {
        return $this->title . " " . $this->first_name . " " . $this->last_name;
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
        return $this->belongsTo(UserRole::class);
    }

    /**
     * Return Organization
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Return Organization
     */
    public function hrmUserBaseSchedules()
    {
        return $this->hasMany(HRMUserBaseSchedule::class);
    }

    /*
    * Get HRMUserBaseSChedule at time
    *
    * @param string $time
    * @param string $day
    * @return HRMUSerBaseSCehdual
    */
    public function hrmUserBaseScheduleAtTimeDay($time, $day)
    {
        return $this->hrmUserBaseSchedules
            ->where('week_day', $day)
            ->where('start_time', '<=', date('H:i:s', $time))
            ->where('end_time', '>', date('H:i:s', $time))->first();
    }

    /**
     * Return Organization
     */
    public function appointments()
    {
        $field_key = 'specialist_id'; //Make a switch for anesthetist role
        return $this->hasMany(Appointment::class,  $field_key, 'id');
    }


    /**
     * Return Organization
     */
    public function isAdmin()
    {
        return $this->role->slug == 'admin';
    }

    public static function create(array $attributes = [])
    {
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

    /*
    * Check if a user has a particular role
    *
    * @param string $role
    * @return boolean
    */
    public function hasRole($role)
    {
        $user_role = $this->role;

        if ($user_role->slug == $role) {
            return true;
        }

        return false;
    }

    /*
    * Check if a user has any one of a set of roles
    *
    * @param array $roles
    * @return boolean
    */
    public function hasAnyRole($roles)
    {
        $user_role = $this->role;

        if (in_array($user_role->slug, $roles)) {
            return true;
        }

        return false;
    }

    /*
    * Check if a user is available to work at a certain time on a certain day
    *
    * @param string $time
    * @param string $day
    * @return boolean
    */
    public function canWorkAt($time, $day)
    {
        if (count($this->hrmUserBaseSchedules
            ->where('week_day', $day)
            ->where('start_time', '<=', date('H:i:s', $time))
            ->where('end_time', '>', date('H:i:s', $time))) > 0) {
            return true;
        }
        return false;
    }

    /*
    * Check if a specialist is has an appointment at a certain time on a certain day
    *
    * @param string $time
    * @param string $day
    * @return boolean
    */
    public function hasAppointmentAtTime($time, $date)
    {
        if (count($this->appointments
            ->where('date',  date('Y-m-d', $date))
            ->where('start_time',  '<=', date('H:i:s', $time))
            ->where('end_time',  '>', date('H:i:s', $time))) > 0) {
            return true;
        }

        return false;
    }

    /*
    * Check if a specialist can undergo a certain appointment at at a certain time on a certain day
    *
    * @param string $time
    * @param string $day
    * @return boolean
    */
    public function canAppointmentTypeAt($time, $day, $appointmentType)
    {
        $schedule = $this->hrmUserBaseSchedules
            ->where('week_day', $day)
            ->where('start_time', '<=', date('H:i:s', $time))
            ->where('end_time', '>', date('H:i:s', $time))
            ->first();

        if ($schedule->appointment_type_restriction == "NONE") {

            return true;
        } else if ($schedule->appointment_type_restriction == $appointmentType->type) {
            return true;
        }
        return false;
    }
}
