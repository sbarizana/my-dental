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
        Schema::create('branches', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('address');
            $table->string('latitude');
            $table->string('longitude');
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
        Schema::dropIfExists('branches');
    }
};
