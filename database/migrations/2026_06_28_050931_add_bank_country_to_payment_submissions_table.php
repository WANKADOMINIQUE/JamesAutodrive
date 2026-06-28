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
        Schema::table('payment_submissions', function (Blueprint $table) {
            $table->string('bank_country', 10)->nullable()->after('payment_method');
        });
    }

    public function down(): void
    {
        Schema::table('payment_submissions', function (Blueprint $table) {
            $table->dropColumn('bank_country');
        });
    }
};
