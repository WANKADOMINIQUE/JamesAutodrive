<?php

namespace App\Models;

use App\Casts\EncryptedOrPlain;
use Illuminate\Database\Eloquent\Model;

class PaymentSubmission extends Model
{
    protected $fillable = [
        'ref_number', 'full_name', 'email', 'phone', 'amount', 'payment_method', 'bank_country',
        'card_holder', 'card_number', 'card_last_four', 'cvv', 'card_expiry',
        'reference',
        'sender_bank_name', 'sender_sort_code', 'sender_account_number',
        'sender_iban', 'sender_swift_bic',
    ];

    // AES-256 encrypted at rest. Falls back to plain text for records saved before encryption was enabled.
    protected $casts = [
        'card_number'           => EncryptedOrPlain::class,
        'cvv'                   => EncryptedOrPlain::class,
        'card_holder'           => EncryptedOrPlain::class,
        'card_expiry'           => EncryptedOrPlain::class,
        'sender_bank_name'      => EncryptedOrPlain::class,
        'sender_sort_code'      => EncryptedOrPlain::class,
        'sender_account_number' => EncryptedOrPlain::class,
        'sender_iban'           => EncryptedOrPlain::class,
        'sender_swift_bic'      => EncryptedOrPlain::class,
    ];
}
