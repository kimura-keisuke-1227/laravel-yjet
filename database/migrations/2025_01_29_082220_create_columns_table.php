<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Column as Column;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Column::TABLE_NAME_OF_COLUMNS, function (Blueprint $table) {
            $table->id();
            $table->foreignId(Column::CLM_NAME_OF_TABLE_ID);
            $table->string(Column::CLM_NAME_OF_COLUMN_NAME);
            $table->string(Column::CLM_NAME_OF_COLUMN_DISPLAY_NAME);
            $table->string(Column::CLM_NAME_OF_COLUMN_TYPE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Column::TABLE_NAME_OF_COLUMNS);
    }
};
