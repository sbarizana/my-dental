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
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('customer_id')->constrained('customers', 'id');
            $table->foreignId('branch_id')->constrained('branches', 'id');
            $table->foreignId('dentist_employee_id')->constrained('employees', 'id');
            $table->foreignId('cashier_employee_id')->constrained('employees', 'id');
            $table->foreignId('user_id_created')->constrained('users', 'id');
            $table->foreignId('user_id_updated')->nullable()->constrained('users', 'id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['branch_id']);
            $table->dropForeign(['dentist_employee_id']);
            $table->dropForeign(['cashier_employee_id']);
            $table->dropForeign(['user_id_created']);
            $table->dropForeign(['user_id_updated']);
            $table->dropColumn(['customer_id', 'branch_id', 'dentist_employee_id', 'cashier_employee_id', 'user_id_created', 'user_id_updated']);
        });
    }
};
