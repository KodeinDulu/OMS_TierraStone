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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique(); // search purpose
            $table->foreignId('sales_id')->constrained('users')->restrictOnDelete();;
            $table->string('customer_name');
            $table->string('customer_phone')->nullable();
            $table->string('customer_email')->nullable();
            $table->enum('status', ['pending', 'on_progress', 'ready_to_deliver', 'rejected', 'done'])->default('pending');
            $table->date('estimated_finish_date')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->enum('production_status', [
                'produksi',
                'klasifikasi_besar',
                'klasifikasi_sedang',
                'klasifikasi_kecil',
                'finishing',
            ])->nullable();
            $table->text('notes')->nullable();
            $table->json('reference_image')->nullable();
            $table->decimal('freight', 12, 2)->default(0);
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
