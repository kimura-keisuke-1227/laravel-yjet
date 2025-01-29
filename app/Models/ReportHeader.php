<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportHeader extends Model
{
    /** @use HasFactory<\Database\Factories\ReportHeaderFactory> */
    use HasFactory;

    const TABLE_NAME_OF_REPORT = 'report_headers';

    const CLM_NAME_OF_ID = 'id';
    const CLM_NAME_OF_REPORT_CODE = 'report_code';
    const CLM_NAME_OF_REPORT_NAME = 'report_name';
    const CLM_NAME_OF_REPORT_REMARK = 'remark';
    const CLM_NAME_OF_IS_ACTIVE = 'is_active';

    protected $fillable = [
        self::CLM_NAME_OF_REPORT_CODE,
        self::CLM_NAME_OF_REPORT_NAME,
        self::CLM_NAME_OF_IS_ACTIVE,
    ];

}
