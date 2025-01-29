<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportDetailTableConector extends Model
{
    /** @use HasFactory<\Database\Factories\ReportDetailTableConectorFactory> */
    use HasFactory;

    const TABLE_NAME_OF_REPORT_TABLE_CONNECTOR = 'report_table_connectors';

    const CLM_NAME_OF_ID = 'id';
    const CLM_NAME_OF_REPORT_HEADER_ID = 'report_header_id';
    const CLM_NAME_OF_LEFT_COLUMN= 'left_column_id';
    const CLM_NAME_OF_RIGHT_COLUMN= 'right_column_id';

    protected $fillable = [
        self::CLM_NAME_OF_REPORT_HEADER_ID,
        self::CLM_NAME_OF_LEFT_COLUMN,
        self::CLM_NAME_OF_RIGHT_COLUMN,
    ];
}
