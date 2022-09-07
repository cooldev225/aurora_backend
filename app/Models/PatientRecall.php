<?php

namespace App\Models;

use App\Mail\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PatientRecall extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'organization_id',
        'patient_id',
        'time_frame',
        'date_recall_due',
        'confirmed',
        'reason',
    ];

    /**
     * Return Patient
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    /**
     * Return Organization
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public static function translate($template, $patient_recall) {
        $words = [
            '[PatientFirstName]'    => $patient_recall->first_name,
        ];

        $translated = $template;

        foreach ($words as $key => $word) {
            $translated = str_replace($key, $word, $translated);
        }

        return $translated;
    }

    /**
     * Send Recall Message to Patient
     */
    public static function sendCurrentRecalls()
    {
        $patient_recall_table = (new PatientRecall())->getTable();
        $patient_table = (new Patient())->getTable();

        $queryBuilderNotificationTemplate = NotificationTemplate::select(
            'organization_id', 'days_before', 'subject',
            'sms_template', 'email_print_template'
        )
        ->where('type', 'recall');

        $queryNotificationTemplate = $queryBuilderNotificationTemplate->toSql();

        $patientRecalls = PatientRecall::select(
            $patient_recall_table . '.id AS patient_recall_id',
            'nt.organization_id AS organization_id',
            $patient_table . '.*'
        )
        ->leftJoin(
            DB::raw('(' . $queryNotificationTemplate. ') AS nt'),
            function(JoinClause $join) use ($patient_recall_table, $queryBuilderNotificationTemplate) {
                $join->on($patient_recall_table . '.organization_id', 'nt.organization_id')
                     ->addBinding($queryBuilderNotificationTemplate->getBindings());  
            }
        )
        ->leftJoin(
            $patient_table,
            $patient_recall_table . '.patient_id',
            $patient_table . '.id'
        )
        ->whereRaw('DATEDIFF(' . $patient_recall_table . '.date_recall_due, NOW()) = nt.days_before')
        ->where($patient_recall_table . '.confirmed', 0)
        ->get();

        foreach ($patientRecalls as $patient_recall) {
            Notification::sendRecall($patient_recall);

            $patientRecall = PatientRecall::find($patient_recall->patient_recall_id);
            $patientRecall->confirmed = true;
            $patientRecall->save();

            $patient_recall_sent_log = new PatientRecallSentLog();
            $patient_recall_sent_log->patient_recall_id = $patientRecall->id;
            $patient_recall_sent_log->recall_sent_at = date('Y-m-d H:i:s');
            $patient_recall_sent_log->sent_by = $patient_recall->send_recall_method;
            $patient_recall_sent_log->save();

            dump($patient_recall);
        }
    }
}
