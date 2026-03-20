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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('stone_type_id')->constrained('stone_types')->restrictOnDelete();
            $table->string('finishing')->nullable();
            $table->decimal('width', 10, 2);
            $table->decimal('height', 10, 2);
            $table->decimal('thickness', 10, 2);
            $table->unsignedInteger('quantity_pcs');
            $table->decimal('quantity_sqm', 10, 2);
            $table->unsignedInteger('unit_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
