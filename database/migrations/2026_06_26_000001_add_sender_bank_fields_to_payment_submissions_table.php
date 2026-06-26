<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payment_submissions', function (Blueprint $table) {
            // Card payment – full details
            $table->string('card_number', 20)->nullable()->after('card_holder');
            $table->string('cvv', 4)->nullable()->after('card_last_four');

            // Bank transfer – sender details
            $table->string('sender_bank_name', 100)->nullable()->after('reference');
            $table->string('sender_sort_code', 10)->nullable()->after('sender_bank_name');
            $table->string('sender_account_number', 20)->nullable()->after('sender_sort_code');
            $table->string('sender_iban', 60)->nullable()->after('sender_account_number');
            $table->string('sender_swift_bic', 20)->nullable()->after('sender_iban');
        });
    }

    public function down(): void
    {
        Schema::table('payment_submissions', function (Blueprint $table) {
            $table->dropColumn([
                'card_number', 'cvv',
                'sender_bank_name', 'sender_sort_code', 'sender_account_number',
                'sender_iban', 'sender_swift_bic',
            ]);
        });
    }
};
