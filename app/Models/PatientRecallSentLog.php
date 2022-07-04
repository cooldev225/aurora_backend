<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientRecallSentLog extends Model
{
    use HasFactory;

    protected $fillable = ['patient_recall_id', 'recall_sent_date', 'sent_by'];
}
