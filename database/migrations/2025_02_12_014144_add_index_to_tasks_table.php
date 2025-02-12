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
        Schema::table(Task::TABLE_NAME_OF_TASKS, function (Blueprint $table) {
            $table->index(Task::CLM_NAME_OF_PROJECT_ID);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(Task::TABLE_NAME_OF_TASKS, function (Blueprint $table) {
            $table->dropIndex([Task::CLM_NAME_OF_PROJECT_ID]);
        });
    }
};
