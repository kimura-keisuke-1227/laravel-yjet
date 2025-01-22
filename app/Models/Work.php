<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    /** @use HasFactory<\Database\Factories\WorkFactory> */
    use HasFactory;

    const TABLE_NAME_OF_WORK = 'works';

    const CLM_NAME_OF_ID = 'id';
    const CLM_NAME_OF_TASK_ID = 'task_id';
    const CLM_NAME_OF_OUT_SOURCE_ID = 'out_source_id';
    const CLM_NAME_OF_WORK_DATE = 'date';
    const CLM_NAME_OF_SCHEDULED_TIME = 'scheduled_time';
    const CLM_NAME_OF_ACTUAL_TIME = 'actual_time';
    const CLM_NAME_OF_CANCELED = 'canceled_at';

    protected $fillable = [
        self::CLM_NAME_OF_TASK_ID,
        self::CLM_NAME_OF_OUT_SOURCE_ID,
        self::CLM_NAME_OF_WORK_DATE,
        self::CLM_NAME_OF_SCHEDULED_TIME,
        self::CLM_NAME_OF_ACTUAL_TIME,
        self::CLM_NAME_OF_CANCELED,
    ];
}
