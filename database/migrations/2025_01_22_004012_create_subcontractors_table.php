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
        Schema::create(Subcontractor::TABLE_NAME_OF_SUBCONTRACTOR, function (Blueprint $table) {
            $table->id();
            $table->string(Subcontractor::CLM_NAME_OF_SUBCONTRACTOR_CODE);
            $table->string(Subcontractor::CLM_NAME_OF_SUBCONTRACTOR_NAME);
            $table->string(Subcontractor::CLM_NAME_OF_SUBCONTRACTOR_ABBREVIATION)->nullable();
            $table->boolean(Subcontractor::CLM_NAME_OF_IS_ACTIVE)->default(True);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Subcontractor::TABLE_NAME_OF_SUBCONTRACTOR);
    }
};
