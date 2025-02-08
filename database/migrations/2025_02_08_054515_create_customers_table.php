<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Customer as Customer;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Customer::TABLE_NAME_OF_CUSTOMER, function (Blueprint $table) {
            $table->id(); // IDカラム
            $table->string(Customer::CLM_NAME_OF_CUSTOMER_CODE); // 顧客コード
            $table->string(Customer::CLM_NAME_OF_CUSTOMER_NAME); // 顧客名
            $table->string(Customer::CLM_NAME_OF_CUSTOMER_OFFICIAL_NAME)->nullable(); // 公式名（NULL可）
            $table->integer(Customer::CLM_NAME_OF_TRANSFER_MONTH)->nullable(); // 振込月（NULL可）
            $table->integer(Customer::CLM_NAME_OF_TRANSFER_DAY)->nullable(); // 振込日（NULL可）
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Customer::TABLE_NAME_OF_CUSTOMER);
    }
};
