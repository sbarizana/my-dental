<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id()->primary();
            // $table->foreignUuid('customer_id')->constrained('customers', 'id');
            // $table->foreignUuid('branch_id')->constrained('branches', 'id');
            // $table->foreignUuid('dentist_employee_id')->constrained('employees', 'id');
            // $table->foreignUuid('cashier_employee_id')->constrained('employees', 'id');
            $table->string('method_payment');
            $table->decimal('total', 10, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
