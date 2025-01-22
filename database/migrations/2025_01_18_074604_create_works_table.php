<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Work as Work;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Work::TABLE_NAME_OF_WORK, function (Blueprint $table) {
            $table->id();
            $table->foreignId(Work::CLM_NAME_OF_TASK_ID);
            $table->foreignId(Work::CLM_NAME_OF_OUT_SOURCE_ID);
            $table->date(Work::CLM_NAME_OF_WORK_DATE);
            $table->integer(Work::CLM_NAME_OF_SCHEDULED_TIME);
            $table->integer(Work::CLM_NAME_OF_ACTUAL_TIME)->nullable();
            $table->text(Work::CLM_NAME_OF_REMARK)->nullable();
            $table->timestamp(Work::CLM_NAME_OF_CANCELED)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
