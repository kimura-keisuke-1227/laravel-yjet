<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    /** @use HasFactory<\Database\Factories\ColumnFactory> */
    use HasFactory;


    const TABLE_NAME_OF_COLUMNS = 'columns';

    const CLM_NAME_OF_TABLE_ID = 'table_id';
    const CLM_NAME_OF_COLUMN_NAME = 'column_name';
    const CLM_NAME_OF_COLUMN_DISPLAY_NAME = 'column_text_name';
    const CLM_NAME_OF_COLUMN_TYPE = 'column_type';
    const CLM_NAME_OF_REMARK = 'remark';

    protected $fillable = [
        self::CLM_NAME_OF_TABLE_ID,
        self::CLM_NAME_OF_COLUMN_NAME,
        self::CLM_NAME_OF_COLUMN_DISPLAY_NAME,
        self::CLM_NAME_OF_REMARK,
    ];
}
