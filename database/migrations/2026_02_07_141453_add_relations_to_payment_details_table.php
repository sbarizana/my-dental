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
        Schema::table('payment_details', function (Blueprint $table) {
            $table->foreignId('payment_id')->constrained('payments', 'id');
            $table->foreignId('product_id')->constrained('products', 'id');
            $table->foreignId('user_id_created')->constrained('users', 'id');
            $table->foreignId('user_id_updated')->nullable()->constrained('users', 'id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_details', function (Blueprint $table) {
            $table->dropForeign(['payment_id']);
            $table->dropForeign(['product_id']);
            $table->dropForeign(['user_id_created']);
            $table->dropForeign(['user_id_updated']);
            $table->dropColumn(['payment_id', 'product_id', 'user_id_created', 'user_id_updated']);
        });
    }
};
