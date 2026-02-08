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
        Schema::table('employees', function (Blueprint $table) {
            $table->foreignId('role_id')->constrained('roles', 'id');
            $table->foreignId('branch_id')->constrained('branches', 'id');
            $table->foreignId('user_id_created')->constrained('users', 'id');
            $table->foreignId('user_id_updated')->nullable()->constrained('users', 'id');

            // Indexes for foreign keys
            $table->index('role_id');
            $table->index('branch_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['branch_id']);
            $table->dropForeign(['user_id_created']);
            $table->dropForeign(['user_id_updated']);
            $table->dropColumn(['role_id', 'branch_id', 'user_id_created', 'user_id_updated']);
        });
    }
};
