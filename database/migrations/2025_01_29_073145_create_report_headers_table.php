<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\ReportHeader as ReportHeader;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(ReportHeader::TABLE_NAME_OF_REPORT, function (Blueprint $table) {
            $table->id();
            $table->string(ReportHeader::CLM_NAME_OF_REPORT_CODE);
            $table->string(ReportHeader::CLM_NAME_OF_REPORT_NAME);
            $table->text(ReportHeader::CLM_NAME_OF_REPORT_REMARK);
            $table->boolean(ReportHeader::CLM_NAME_OF_IS_ACTIVE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ReportHeader::TABLE_NAME_OF_REPORT);
    }
};
