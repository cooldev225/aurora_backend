<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Anesthetist extends Model
{
    use HasFactory;

    public static function appointmentsByAnesthetist($anesthetist_id) {
        $appointment_table = (new Appointment())->getTable();
        $appointment_type_table = (new AppointmentType())->getTable();
        $appointment_pre_admission_table = (new AppointmentPreAdmission())->getTable();
        $patient_table = (new Patient())->getTable();
        $specialist_title_table = (new SpecialistTitle())->getTable();
        $specialist_table = (new Specialist())->getTable();
        $employee_table = (new Employee())->getTable();
        $user_table = (new User())->getTable();

        return Appointment::select(
            $appointment_table . '.*',
            DB::raw('CONCAT(' . $specialist_title_table . '.name, " ",'
                . $user_table . '.first_name, " ",'
                . $user_table . '.last_name) AS specialist_name'),
            $appointment_type_table  . '.name AS appointment_type_name'
        )
        ->leftJoin(
            $appointment_type_table,
            $appointment_table . '.appointment_type_id',
            $appointment_type_table . '.id'
        )
        ->leftJoin(
            $appointment_pre_admission_table,
            $appointment_table . '.id',
            $appointment_pre_admission_table . '.appointment_id'
        )
        ->leftJoin(
            $patient_table,
            'patient_id',
            $patient_table. ".id"
        )
        ->leftJoin(
            $specialist_table,
            $appointment_table . '.specialist_id',
            $specialist_table . '.id'
        )
        ->leftJoin(
            $specialist_title_table,
            $specialist_table . '.specialist_title_id',
            $specialist_title_table . '.id'
        )
        ->leftJoin(
            $employee_table,
            $specialist_table . '.employee_id',
            $employee_table . '.id'
        )
        ->leftJoin(
            $user_table,
            $employee_table . '.user_id',
            $user_table . '.id'
        )
        ->where($appointment_table . '.anesthetist_id', $anesthetist_id)
        ->where('procedure_approval_status', '!=', 'NOT_RELEVANT')
        ->get();
    }
}
