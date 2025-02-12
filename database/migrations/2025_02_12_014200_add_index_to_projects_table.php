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
            $table->index(Project::CLM_NAME_OF_USER_ID);
            $table->index(Project::CLM_NAME_OF_CUSTOMER_ID);
            $table->index(Project::CLM_NAME_OF_END_DATE);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(Project::TABLE_NAME_OF_PROJECTS, function (Blueprint $table) {
            $table->dropIndex([Project::CLM_NAME_OF_USER_ID]);
            $table->dropIndex([Project::CLM_NAME_OF_CUSTOMER_ID]);
            $table->dropIndex([Project::CLM_NAME_OF_END_DATE]);
        });
    }
};
