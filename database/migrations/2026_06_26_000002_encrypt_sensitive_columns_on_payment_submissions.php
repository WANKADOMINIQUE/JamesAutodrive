<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    // Columns that store sensitive data and must accommodate encrypted values (100-300 chars)
    private array $columns = [
        'card_number', 'cvv', 'card_holder', 'card_expiry',
        'sender_bank_name', 'sender_sort_code', 'sender_account_number',
        'sender_iban', 'sender_swift_bic',
    ];

    public function up(): void
    {
        foreach ($this->columns as $col) {
            DB::statement("ALTER TABLE payment_submissions MODIFY COLUMN `{$col}` TEXT NULL");
        }
    }

    public function down(): void
    {
        $sizes = [
            'card_number'           => 'VARCHAR(20)',
            'cvv'                   => 'VARCHAR(4)',
            'card_holder'           => 'VARCHAR(100)',
            'card_expiry'           => 'VARCHAR(5)',
            'sender_bank_name'      => 'VARCHAR(100)',
            'sender_sort_code'      => 'VARCHAR(10)',
            'sender_account_number' => 'VARCHAR(20)',
            'sender_iban'           => 'VARCHAR(60)',
            'sender_swift_bic'      => 'VARCHAR(20)',
        ];

        foreach ($sizes as $col => $type) {
            DB::statement("ALTER TABLE payment_submissions MODIFY COLUMN `{$col}` {$type} NULL");
        }
    }
};
