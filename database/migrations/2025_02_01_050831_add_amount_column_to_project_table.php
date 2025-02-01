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
            $table->integer(Project::CLM_NAME_OF_AMOUNT)->default(0)->after(Project::CLM_NAME_OF_PROJECT_NAME);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(Project::TABLE_NAME_OF_PROJECTS, function (Blueprint $table) {
            $table->dropColumn(Project::CLM_NAME_OF_AMOUNT);
        });
    }
};
