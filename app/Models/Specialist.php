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
        'anesthetist_id',
    ];

    protected $appends = [
        'name'
    ];

    /**
     * Return Specialist Name
     */
    public function getNameAttribute()
    {
        if ($this->employee == null) {
            return $this->id . ' : ' . $this->employee_id;
        } else if ($this->employee->user == null) {
            return 'u ' . $this->employee->id;
        }

        return $this->employee->user->title . ' '
            . $this->employee->user->first_name . ' '
            . $this->employee->user->last_name;
    }

    /**
     * Return Employee
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
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
        $anesthetist_table = "{$employee_table} AS anesthetists";
        $anesthetist_user_table = "{$user_table} AS anesthetist_users";

        $specialist_list = self::select(
            $specialist_table . '.employee_id',    
            $specialist_table . '.id',
            $employee_table . '.user_id',
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
            )->where($user_table . '.organization_id', $organization_id);

        return $specialist_list;
    }

    /**
     * Return $appointments
     */
    public static function withAppointments()
    {
   
        $organization_id = auth()->user()->organization_id;
    

        $appointment_table = (new Appointment())->getTable();
        $patient_table = (new Patient())->getTable();
        $specialist_table = (new Specialist())->getTable();
        $clinic_table = (new Clinic())->getTable();
        $appointment_type_table = (new AppointmentType())->getTable();
        $employee_table = (new Employee())->getTable();
        $user_table = (new User())->getTable();
        $user_table = (new User())->getTable();
        $appointment_referral_table = (new AppointmentReferral())->getTable();
        $referring_doctor_table = (new ReferringDoctor())->getTable();

        $appointments = self::select(
            "{$appointment_table}.id",
            "{$appointment_table}.*",
            "{$appointment_type_table}.*",
            "{$patient_table}.*",
            "{$appointment_referral_table}.*",
            DB::raw(
                "CONCAT({$user_table}.first_name, ' ', "
                . "{$user_table}.last_name) AS specialist_name"
            ),
            "{$appointment_type_table}.name AS appointment_type_name",
            "{$clinic_table}.name AS clinic_name",
            DB::raw(
                "CONCAT({$referring_doctor_table}.title, ' ', "
                . "{$referring_doctor_table}.first_name, ' ', "
                . "{$referring_doctor_table}.last_name) AS referring_doctor_name"
            ),
            $specialist_table . '.employee_id'
        )
            ->leftJoin(
                $employee_table,
                'employee_id',
                '=',
                $employee_table . '.id'
            )
            ->leftJoin($user_table, 'user_id', '=', $user_table . '.id')
            ->rightJoin(
                $appointment_table,
                'specialist_id',
                '=',
                "{$specialist_table}.id"
            )
            ->leftJoin($patient_table, 'patient_id', '=', "{$patient_table}.id")
            ->leftJoin(
                $appointment_type_table,
                'appointment_type_id',
                '=',
                $appointment_type_table . '.id'
            )
            ->leftJoin(
                $appointment_referral_table,
                $appointment_table . '.id',
                '=',
                $appointment_referral_table . '.appointment_id'
            )
            ->leftJoin(
                $referring_doctor_table,
                $appointment_referral_table . '.referring_doctor_id',
                $referring_doctor_table . '.id'
            )
            ->leftJoin($clinic_table, 'clinic_id', '=', $clinic_table . '.id')
            ->where($appointment_table . '.organization_id', $organization_id);

        return $appointments;
    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }
}
