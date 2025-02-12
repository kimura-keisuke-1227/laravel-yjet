<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Work;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table(Work::TABLE_NAME_OF_WORK, function (Blueprint $table) {
            // インデックスの追加
            $table->index(Work::CLM_NAME_OF_TASK_ID);
            $table->index(Work::CLM_NAME_OF_USER_ID);
            $table->index(Work::CLM_NAME_OF_OUT_SOURCE_ID);
            $table->index(Work::CLM_NAME_OF_WORK_DATE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table(Work::TABLE_NAME_OF_WORK, function (Blueprint $table) {
            // インデックスの削除
            $table->dropIndex([Work::CLM_NAME_OF_TASK_ID]);
            $table->dropIndex([Work::CLM_NAME_OF_USER_ID]);
            $table->dropIndex([Work::CLM_NAME_OF_OUT_SOURCE_ID]);
            $table->dropIndex([Work::CLM_NAME_OF_WORK_DATE]);
        });
    }
};
