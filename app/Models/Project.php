<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    const TABLE_NAME_OF_PROJECTS = 'projects';

    const CLM_NAME_OF_ID = 'id';
    const CLM_NAME_OF_START_DATE = 'start_date';
    const CLM_NAME_OF_END_DATE = 'end_date';
    const CLM_NAME_OF_PROJECT_NAME = 'project_name';
    const CLM_NAME_OF_USER_ID = 'user_id';


    protected $fillable = [
        self::CLM_NAME_OF_START_DATE,
        self::CLM_NAME_OF_END_DATE,
        self::CLM_NAME_OF_PROJECT_NAME,
        self::CLM_NAME_OF_USER_ID,
    ];

    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }
}
