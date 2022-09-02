<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'type', 'document_letter_header',
        'document_letter_footer', 'signature'
    ];

    protected $appends = [
        'role'
    ];


    /**
     * Return Specialist Name
     */
    public function getRoleAttribute()
    {
 

        return $this->user->role;
    }

    /**
     * Return User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Return specialist
     */
    public function specialist()
    {
        return $this->hasOne(Specialist::class, 'employee_id');
    }

    /**
     * Return anesthetist
     */
    public function specialist_from_anesthetist()
    {
        return $this->hasOne(Specialist::class, 'anesthetist_id');
    }

    /**
     * Return $anesthetist_list
     */
    public static function anesthetists($organization_id = null)
    {
        if ($organization_id == null) {
            $organization_id = auth()->user()->organization_id;
        }

        $user_table = (new User())->getTable();
        $user_role_table = (new UserRole())->getTable();
        $employee_table = (new self())->getTable();

        $anesthetist_list = self::leftJoin(
            $user_table,
            'user_id',
            '=',
            $user_table . '.id'
        )
            ->select('*', "{$employee_table}.id")
            ->leftJoin(
                $user_role_table,
                'role_id',
                '=',
                $user_role_table . '.id'
            )
            ->where($user_table . '.organization_id', $organization_id)
            ->where('slug', 'anesthetist');

        return $anesthetist_list;
    }
}
