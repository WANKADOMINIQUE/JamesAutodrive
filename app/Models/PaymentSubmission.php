<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSubmission extends Model
{
    protected $fillable = [
        'ref_number', 'full_name', 'email', 'phone', 'amount',
        'payment_method', 'card_holder', 'card_last_four', 'card_expiry', 'reference',
    ];
}
