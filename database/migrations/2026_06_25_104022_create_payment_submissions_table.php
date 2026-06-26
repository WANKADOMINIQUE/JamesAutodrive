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
        Schema::create('payment_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('ref_number', 20)->unique();
            $table->string('full_name', 100);
            $table->string('email', 150)->index();
            $table->string('phone', 30);
            $table->decimal('amount', 10, 2);
            $table->string('payment_method', 20)->default('card');
            $table->string('card_holder', 100)->nullable();
            $table->string('card_last_four', 4)->nullable();
            $table->string('card_expiry', 5)->nullable();
            $table->string('reference', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_submissions');
    }
};
