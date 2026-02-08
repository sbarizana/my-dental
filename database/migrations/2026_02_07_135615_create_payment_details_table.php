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
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id()->primary();
            // $table->foreignUuid('payment_id')->constrained('payments', 'id');
            // $table->foreignUuid('product_id')->constrained('products', 'id');
            // $table->foreignUuid('user_id_created')->constrained('users', 'id');
            // $table->foreignUuid('user_id_updated')->nullable()->constrained('users', 'id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_details');
    }
};
