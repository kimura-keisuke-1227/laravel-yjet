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
        Schema::create(Project::TABLE_NAME_OF_PROJECTS, function (Blueprint $table) {
            $table->id();
            $table->string(Project::CLM_NAME_OF_PROJECT_NAME);
            $table->foreignId(Project::CLM_NAME_OF_USER_ID);
            $table->date(Project::CLM_NAME_OF_START_DATE);
            $table->date(Project::CLM_NAME_OF_END_DATE)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Project::TABLE_NAME_OF_PROJECTS);
    }
};
