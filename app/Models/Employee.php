<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'type', 'work_hours', 'document_letter_header',
        'document_letter_footer', 'signature'
    ];

    /**
     * Return User
     */
    public function user()
    {
        return $this->belongsTo(User::class)->first();
    }

    /**
     * Return specialist
     */
    public function specialist()
    {
        return $this->hasOne(Specialist::class, 'employee_id');
    }

    /**
     * Return $pathologist_list
     */
    public static function pathologists($organization_id = null)
    {
        if ($organization_id == null) {
            $organization_id = auth()->user()->organization_id;
        }

        $user_table = (new User())->getTable();
        $user_role_table = (new UserRole())->getTable();

        $pathologist_list = self::leftJoin(
            $user_table,
            'user_id',
            '=',
            $user_table . '.id'
        )
            ->leftJoin(
                $user_role_table,
                'role_id',
                '=',
                $user_role_table . '.id'
            )
            ->where($user_table . '.organization_id', $organization_id)
            ->where('slug', 'pathologist');

        return $pathologist_list;
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

        $anesthetist_list = self::leftJoin(
            $user_table,
            'user_id',
            '=',
            $user_table . '.id'
        )
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
