<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'entity', 'teacher_nif', 'type', 'course_type', 'gross_salary', 'net_salary', 'retentions', 'formative_planning', 'case_file',
        'annuity', 'agreement', 'other_agreements', 'sector', 'course', 'init_date', 'end_date', 'total_hours', 'daily_hours', 'schedule',
        'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'location', 'observations', 'communication_date',
        'processing_date', 'company_code', 'employee_code', 'INEM_code', 'processed'
    ];
}
