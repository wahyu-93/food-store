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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customer')->cascadeOnDelete();
            $table->foreignId('province_id')->constrained('province')->cascadeOnDelete();
            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete();
            $table->foreignId('district_id')->constrained('district')->cascadeOnDelete();
            $table->string('invoice');
            $table->integer('weight');
            $table->text('address');
            $table->decimal('total', 8, 2);
            $table->enum('status', ['pending', 'success', 'expired', 'failed'])->default('pending');
            $table->string('snap_token')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
