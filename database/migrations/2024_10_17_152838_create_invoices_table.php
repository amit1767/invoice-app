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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('invoice_number', 6);
            $table->decimal('total_amount', 10, 2)->default(250.50);
            $table->decimal('amount_paid', 10, 2)->default(0);
            $table->decimal('remaining_balance', 10, 2);
            $table->enum('status', ['Pending', 'Partially Paid', 'Paid'])->default('Pending');
            $table->integer('transaction_count')->default(0);
            $table->date('due_date');
            $table->decimal('late_fee', 10, 2)->default(0);
            $table->decimal('interest', 10, 2)->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
