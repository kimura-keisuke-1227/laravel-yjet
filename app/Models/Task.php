<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    const TABLE_NAME_OF_TASKS = 'tasks';

    const CLM_NAME_OF_PROJECT_ID = 'project_id';
    const CLM_NAME_OF_TASK_NAME = 'task_name';
    const CLM_NAME_OF_REMARK = 'remark';
    const CLM_NAME_OF_IS_EXPIRE = 'is_expire';

    protected $fillable = [
        self::CLM_NAME_OF_PROJECT_ID,
        self::CLM_NAME_OF_TASK_NAME,
        self::CLM_NAME_OF_REMARK,
        self::CLM_NAME_OF_IS_EXPIRE,
    ];

    public function project(){
        return $this -> belongsTo('App\Models\Project');
    }

    public function works(){
        return $this -> hasMany('App\Models\Work')->orderBy('date', 'desc')->orderBy('created_at', 'desc');
    }
}
