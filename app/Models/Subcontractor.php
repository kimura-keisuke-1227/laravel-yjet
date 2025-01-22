<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcontractor extends Model
{
    /** @use HasFactory<\Database\Factories\SubcontractorFactory> */
    use HasFactory;

    const TABLE_NAME_OF_SUBCONTRACTOR = 'subcontractors';

    const CLM_NAME_OF_ID = 'id';
    const CLM_NAME_OF_SUBCONTRACTOR_CODE = 'subcontractor_code';
    const CLM_NAME_OF_SUBCONTRACTOR_NAME = 'subcontractor_name';
    const CLM_NAME_OF_SUBCONTRACTOR_ABBREVIATION = 'subcontractor_abbreviation';
    const CLM_NAME_OF_IS_ACTIVE = 'is_active';

    protected $fillable = [
        self::CLM_NAME_OF_SUBCONTRACTOR_CODE,
        self::CLM_NAME_OF_SUBCONTRACTOR_NAME,
        self::CLM_NAME_OF_SUBCONTRACTOR_ABBREVIATION,
        self::CLM_NAME_OF_IS_ACTIVE,
    ];
}
