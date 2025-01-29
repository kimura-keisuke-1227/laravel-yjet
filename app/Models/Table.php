<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    /** @use HasFactory<\Database\Factories\TableFactory> */
    use HasFactory;

    const TABLE_NAME_OF_TABLES = 'tables';

    const CLM_NAME_OF_TABLE_NAME = 'table_name';
    const CLM_NAME_OF_TABLE_DISPLAY_NAME = 'table_text_name';
    const CLM_NAME_OF_REMARK = 'remark';

    protected $fillable = [
        self::CLM_NAME_OF_TABLE_NAME,
        self::CLM_NAME_OF_TABLE_DISPLAY_NAME,
        self::CLM_NAME_OF_REMARK,
    ];
}
