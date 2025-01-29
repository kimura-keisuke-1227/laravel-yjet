<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\ReportDetailTableConnector as ReportDetailTableConnector;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(ReportDetailTableConnector::TABLE_NAME_OF_REPORT_TABLE_CONNECTOR, function (Blueprint $table) {
            $table->id();
            $table->foreignId(ReportDetailTableConnector::CLM_NAME_OF_REPORT_HEADER_ID);
            $table->foreignId(ReportDetailTableConnector::CLM_NAME_OF_LEFT_COLUMN);
            $table->foreignId(ReportDetailTableConnector::CLM_NAME_OF_RIGHT_COLUMN);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_detail_table_conectors');
    }
};
