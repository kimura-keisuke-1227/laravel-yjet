<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Task as Task;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Task::TABLE_NAME_OF_TASKS, function (Blueprint $table) {
            $table->id();
            $table->string(Task::CLM_NAME_OF_TASK_NAME);
            $table->foreignId(Task::CLM_NAME_OF_PROJECT_ID);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Task::TABLE_NAME_OF_TASKS);
    }
};
