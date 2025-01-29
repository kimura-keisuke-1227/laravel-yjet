<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Table as Table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Table::TABLE_NAME_OF_TABLES, function (Blueprint $table) {
            $table->id();
            $table->string(Table::CLM_NAME_OF_TABLE_NAME);
            $table->string(Table::CLM_NAME_OF_TABLE_DISPLAY_NAME);
            $table->text(Table::CLM_NAME_OF_REMARK);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Table::TABLE_NAME_OF_TABLES);
    }
};
