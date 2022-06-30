<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Specialist extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'specialist_title_id',
        'specialist_type_id',
        'anesthetist_id',
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
    public static function organizationSpecialists($organization_id = null)
    {
        if ($organization_id == null) {
            $organization_id = auth()->user()->organization_id;
        }

        $employee_table = (new Employee())->getTable();
        $user_table = (new User())->getTable();
        $specialist_table = (new Specialist())->getTable();
        $specialist_title_table = (new SpecialistTitle())->getTable();
        $specialist_type_table = (new SpecialistType())->getTable();
        $anesthetist_table = "{$employee_table} AS anesthetists";
        $anesthetist_user_table = "{$user_table} AS anesthetist_users";

        $specialist_list = self::select(
            $specialist_table . '.id',
            DB::raw(
                "CONCAT({$specialist_title_table}.name, ' ', {$user_table}.first_name, ' ', {$user_table}.last_name) AS name"
            ),
            $employee_table . '.work_hours',
            'anesthetist_id',
            DB::raw(
                "CONCAT(anesthetist_users.first_name, ' ', anesthetist_users.last_name) AS anesthetist_name"
            )
        )
            ->leftJoin(
                $employee_table,
                'employee_id',
                '=',
                $employee_table . '.id'
            )
            ->leftJoin($user_table, 'user_id', '=', $user_table . '.id')
            ->leftJoin(
                $anesthetist_table,
                'anesthetist_id',
                '=',
                'anesthetists.id'
            )
            ->leftJoin(
                $anesthetist_user_table,
                'anesthetists.user_id',
                '=',
                'anesthetist_users.id'
            )
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

    /**
     * Return $appointments
     */
    public static function withAppointments()
    {
        $appointment_table = (new Appointment())->getTable();
        $patient_table = (new Patient())->getTable();
        $specialist_table = (new Specialist())->getTable();

        $appointments = self::select(
            'patient_id',
            $patient_table . '.first_name',
            $patient_table . '.last_name',
            'specialist_id',
            'date',
            'start_time',
            'end_time',
            'confirmation_status',
            'attendance_status',
            'payment_status'
        )
            ->rightJoin(
                $appointment_table,
                'specialist_id',
                '=',
                $specialist_table . '.id'
            )
            ->leftJoin(
                $patient_table,
                'patient_id',
                '=',
                $patient_table . '.id'
            );

        return $appointments;
    }
}
