<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'specialist_title_id',
        'specialist_type_id',
    ];

    /**
     * Return User
     */
    public function user()
    {
        return $this->belongsTo(User::class)->first();
    }

    /**
     * Return $specialist_list
     */
    public static function organizationSpecialists()
    {
        $organization_id = auth()->user()->organization_id;

        $employee_table = (new Employee())->getTable();
        $user_table = (new User())->getTable();
        $specialist_title_table = (new SpecialistTitle())->getTable();
        $specialist_type_table = (new SpecialistType())->getTable();

        $specialist_list = self::leftJoin(
            $employee_table,
            'employee_id',
            '=',
            $employee_table . '.id'
        )
            ->leftJoin($user_table, 'user_id', '=', $user_table . '.id')
            ->leftJoin(
                $specialist_title_table,
                'specialist_title_id',
                '=',
                $specialist_title_table . '.id'
            )
            ->leftJoin(
                $specialist_type_table,
                'specialist_type_id',
                '=',
                $specialist_type_table . '.id'
            )
            ->where($user_table . '.organization_id', $organization_id);

        return $specialist_list;
    }
}
