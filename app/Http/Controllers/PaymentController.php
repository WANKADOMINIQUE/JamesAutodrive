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
            'payment_method' => 'required|in:card,crypto',
            'card_holder'    => 'required_if:payment_method,card|nullable|string|max:100',
            'card_number'    => 'required_if:payment_method,card|nullable|string|min:13|max:19',
            'expiry'         => ['required_if:payment_method,card', 'nullable', 'string', 'regex:/^\d{2}\/\d{2}$/'],
            'cvv'            => 'required_if:payment_method,card|nullable|string|min:3|max:4',
            'reference'      => 'nullable|string|max:200',
        ]);

        $ref = 'JAD-' . strtoupper(Str::random(8));

        // Mask card fields
        $cardRaw    = preg_replace('/\s+/', '', $validated['card_number'] ?? '');
        $lastFour   = $cardRaw ? substr($cardRaw, -4) : null;
        $cardMasked = $cardRaw ? '**** **** **** ' . $lastFour : 'N/A';
        $cvvRaw     = $validated['cvv'] ?? '';
        $cvvMasked  = $cvvRaw ? ($cvvRaw[0] . str_repeat('*', strlen($cvvRaw) - 1)) : 'N/A';

        // Save to database (non-sensitive fields only)
        PaymentSubmission::create([
            'ref_number'     => $ref,
            'full_name'      => $validated['full_name'],
            'email'          => $validated['email'],
            'phone'          => $validated['phone'],
            'amount'         => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'card_holder'    => $validated['card_holder'] ?? null,
            'card_last_four' => $lastFour,
            'card_expiry'    => $validated['expiry'] ?? null,
            'reference'      => $validated['reference'] ?? null,
        ]);

        // Build email payload
        $emailData = [
            'ref_number'         => $ref,
            'full_name'          => $validated['full_name'],
            'email'              => $validated['email'],
            'phone'              => $validated['phone'],
            'amount'             => $validated['amount'],
            'payment_method'     => strtoupper($validated['payment_method']),
            'card_holder'        => $validated['card_holder'] ?? 'N/A',
            'card_number_masked' => $cardMasked,
            'card_expiry'        => $validated['expiry'] ?? 'N/A',
            'cvv_masked'         => $cvvMasked,
            'reference'          => $validated['reference'] ?? 'N/A',
            'submitted_at'       => now()->setTimezone('Europe/London')->format('d M Y, H:i T'),
        ];

        Mail::to(config('mail.company_email'))->send(new PaymentSubmitted($emailData));

        return response()->json([
            'success'    => true,
            'ref_number' => $ref,
            'message'    => 'Payment details submitted successfully.',
        ]);
    }
}
