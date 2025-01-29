<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Project as Project;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table(Project::TABLE_NAME_OF_PROJECTS, function (Blueprint $table) {
            $table->text(Project::CLM_NAME_OF_REMARK)->comment('メモ')->after(Project::CLM_NAME_OF_PROJECT_NAME)->nullable();          // 構文
            $table->boolean(Project::CLM_NAME_OF_IS_EXPIRE)->comment('完了')->after(Project::CLM_NAME_OF_REMARK)->nullable();          // 構文
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(Project::TABLE_NAME_OF_PROJECTS, function (Blueprint $table) {
            $table->dropColumn(Project::CLM_NAME_OF_REMARK);
            $table->dropColumn(Project::CLM_NAME_OF_IS_EXPIRE);
        });
    }
};
