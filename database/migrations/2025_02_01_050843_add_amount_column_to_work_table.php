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
        Schema::table(Work::TABLE_NAME_OF_WORK, function (Blueprint $table) {
            $table->integer(Work::CLM_NAME_OF_AMOUNT)->default(0)->after(Work::CLM_NAME_OF_ACTUAL_TIME);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(Work::TABLE_NAME_OF_WORK, function (Blueprint $table) {
            $table->dropColumn(Work::CLM_NAME_OF_AMOUNT);
        });
    }
};
