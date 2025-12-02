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
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        // Nullable karena mungkin nanti user beli hotel saja (opsional)
        $table->foreignId('destination_id')->nullable()->constrained()->nullOnDelete();
        $table->integer('quantity');
        $table->decimal('total_price', 12, 2);
        $table->enum('status', ['pending', 'paid', 'cancelled', 'refunded'])->default('pending');
        $table->string('payment_proof')->nullable(); // Bukti transfer
        $table->text('refund_note')->nullable(); // Alasan refund dari admin
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
