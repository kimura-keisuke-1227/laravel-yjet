<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Subcontractor as Subcontractor;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table(Subcontractor::TABLE_NAME_OF_SUBCONTRACTOR, function (Blueprint $table) {
            $table->index(Subcontractor::CLM_NAME_OF_SUBCONTRACTOR_CODE);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(Subcontractor::TABLE_NAME_OF_SUBCONTRACTOR, function (Blueprint $table) {
            $table->dropIndex([Subcontractor::CLM_NAME_OF_SUBCONTRACTOR_CODE]);
        });
    }
};
