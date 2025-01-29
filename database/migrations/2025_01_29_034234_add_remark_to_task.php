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
            $table->text(Task::CLM_NAME_OF_REMARK)->comment('メモ')->after(Task::CLM_NAME_OF_TASK_NAME)->nullable();          // 構文
            $table->boolean(Task::CLM_NAME_OF_IS_EXPIRE)->comment('完了')->after(Task::CLM_NAME_OF_REMARK)->nullable();          // 構文
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(Task::TABLE_NAME_OF_TASKS, function (Blueprint $table) {
            $table->dropColumn(Task::CLM_NAME_OF_REMARK);
            $table->dropColumn(Task::CLM_NAME_OF_IS_EXPIRE);           //
        });
    }
};
