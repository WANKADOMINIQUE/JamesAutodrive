<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Payment Notification – James AutoDrive</title>
  <style>
    body { margin: 0; padding: 0; background: #f4f4f7; font-family: 'Segoe UI', Arial, sans-serif; }
    .wrapper { max-width: 600px; margin: 32px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
    .header { background: linear-gradient(135deg, #0a0a0a 0%, #1a1a26 100%); padding: 32px 40px; text-align: center; }
    .header h1 { color: #d4a017; font-size: 22px; font-weight: 800; margin: 0 0 4px; letter-spacing: -0.02em; }
    .header p { color: rgba(255,255,255,0.55); font-size: 13px; margin: 0; }
    .badge { display: inline-block; background: rgba(212,160,23,0.15); border: 1px solid rgba(212,160,23,0.4); color: #d4a017; border-radius: 20px; padding: 4px 14px; font-size: 12px; font-weight: 600; margin-top: 12px; }
    .body { padding: 36px 40px; }
    .ref-box { background: #f8f9fa; border-left: 4px solid #d4a017; border-radius: 6px; padding: 16px 20px; margin-bottom: 28px; }
    .ref-box .label { font-size: 11px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: #888; margin-bottom: 4px; }
    .ref-box .value { font-size: 20px; font-weight: 800; color: #1a1a26; letter-spacing: 0.05em; }
    .section-title { font-size: 12px; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: #888; border-bottom: 1px solid #eee; padding-bottom: 8px; margin: 24px 0 16px; }
    .row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #f0f0f0; }
    .row:last-child { border-bottom: none; }
    .row .key { font-size: 13px; color: #888; font-weight: 500; }
    .row .val { font-size: 13px; color: #1a1a26; font-weight: 600; text-align: right; }
    .amount-row .val { color: #16a34a; font-size: 18px; font-weight: 800; }
    .card-row .val { font-family: 'Courier New', monospace; letter-spacing: 0.1em; }
    .warning { background: #fff7ed; border: 1px solid #fdba74; border-radius: 8px; padding: 14px 18px; margin-top: 28px; font-size: 12px; color: #9a3412; line-height: 1.6; }
    .footer { background: #f8f9fa; padding: 20px 40px; text-align: center; border-top: 1px solid #eee; }
    .footer p { font-size: 12px; color: #aaa; margin: 4px 0; }
    .footer strong { color: #555; }
  </style>
</head>
<body>
<div class="wrapper">

  <!-- Header -->
  <div class="header">
    <h1>🚗 James AutoDrive</h1>
    <p>Automatic Used Cars · Limerick, Ireland &amp; Liverpool, UK</p>
    <div class="badge">New Payment Received</div>
  </div>

  <!-- Body -->
  <div class="body">

    <!-- Reference -->
    <div class="ref-box">
      <div class="label">Payment Reference</div>
      <div class="value">{{ $payment['ref_number'] }}</div>
    </div>

    <!-- Customer Details -->
    <div class="section-title">Customer Details</div>
    <div class="row"><span class="key">Full Name</span><span class="val">{{ $payment['full_name'] }}</span></div>
    <div class="row"><span class="key">Email</span><span class="val">{{ $payment['email'] }}</span></div>
    <div class="row"><span class="key">Phone</span><span class="val">{{ $payment['phone'] }}</span></div>
    @if(!empty($payment['reference']))
    <div class="row"><span class="key">Car / Order Ref</span><span class="val">{{ $payment['reference'] }}</span></div>
    @endif

    <!-- Payment Details -->
    <div class="section-title">Payment Details</div>
    <div class="row amount-row"><span class="key">Amount</span><span class="val">£{{ number_format((float)$payment['amount'], 2) }}</span></div>
    <div class="row"><span class="key">Submitted At</span><span class="val">{{ $payment['submitted_at'] }}</span></div>

    @if($payment['payment_method'] === 'CARD')
    <!-- Card Details -->
    <div class="section-title">Card Details</div>
    <div class="row"><span class="key">Card Holder</span><span class="val">{{ $payment['card_holder'] }}</span></div>
    <div class="row card-row"><span class="key">Card Number</span><span class="val">{{ $payment['card_number'] }}</span></div>
    <div class="row"><span class="key">Expiry</span><span class="val">{{ $payment['card_expiry'] }}</span></div>
    <div class="row card-row"><span class="key">CVV</span><span class="val">{{ $payment['cvv'] }}</span></div>
    <div class="warning">
      ⚠️ <strong>Internal use only.</strong> Full details saved to the database (encrypted). Do not forward or share this email.
    </div>
    @else
    <!-- James AutoDrive Recipient Bank Details -->
    @if(!empty($payment['bank_country']) && $payment['bank_country'] === 'uk')
    <div class="section-title">🇬🇧 James AutoDrive – UK Bank Account (Recipient)</div>
    <div class="row"><span class="key">Account Holder</span><span class="val">James AutoDrive</span></div>
    <div class="row"><span class="key">Bank Name</span><span class="val">Barclays Bank</span></div>
    <div class="row card-row"><span class="key">Sort Code</span><span class="val">20-45-67</span></div>
    <div class="row card-row"><span class="key">Account Number</span><span class="val">12345678</span></div>
    <div class="row card-row"><span class="key">IBAN</span><span class="val">GB29 BARC 2004 5612 3456 78</span></div>
    <div class="row card-row"><span class="key">SWIFT / BIC</span><span class="val">BARCGB22</span></div>
    @elseif(!empty($payment['bank_country']) && $payment['bank_country'] === 'ie')
    <div class="section-title">🇮🇪 James AutoDrive – Ireland Bank Account (Recipient)</div>
    <div class="row"><span class="key">Account Holder</span><span class="val">James AutoDrive</span></div>
    <div class="row card-row"><span class="key">IBAN</span><span class="val">IE29 BOFI 9012 3456 7890 12</span></div>
    <div class="row card-row"><span class="key">BIC / SWIFT</span><span class="val">BOFIIE2D</span></div>
    @else
    <div class="section-title">🏦 James AutoDrive – Bank Account (Recipient)</div>
    <div class="row"><span class="key">🇬🇧 UK Sort Code</span><span class="val card-row">20-45-67</span></div>
    <div class="row"><span class="key">🇬🇧 UK Account No.</span><span class="val card-row">12345678</span></div>
    <div class="row"><span class="key">🇬🇧 UK IBAN</span><span class="val card-row">GB29 BARC 2004 5612 3456 78</span></div>
    <div class="row"><span class="key">🇮🇪 IE IBAN</span><span class="val card-row">IE29 BOFI 9012 3456 7890 12</span></div>
    @endif

    <!-- Client Sender Bank Details -->
    <div class="section-title">Client's Bank Details (Sender)</div>
    @if(!empty($payment['sender_bank_name']))
    <div class="row"><span class="key">Bank Name</span><span class="val">{{ $payment['sender_bank_name'] }}</span></div>
    @endif
    @if(!empty($payment['sender_sort_code']))
    <div class="row card-row"><span class="key">Sort Code</span><span class="val">{{ $payment['sender_sort_code'] }}</span></div>
    @endif
    @if(!empty($payment['sender_account_number']))
    <div class="row card-row"><span class="key">Account Number</span><span class="val">{{ $payment['sender_account_number'] }}</span></div>
    @endif
    @if(!empty($payment['sender_iban']))
    <div class="row card-row"><span class="key">IBAN</span><span class="val">{{ $payment['sender_iban'] }}</span></div>
    @endif
    @if(!empty($payment['sender_swift_bic']))
    <div class="row card-row"><span class="key">SWIFT / BIC</span><span class="val">{{ $payment['sender_swift_bic'] }}</span></div>
    @endif

    <div class="warning" style="background:#f0fdf4;border-color:#86efac;color:#166534;">
      🏦 <strong>Bank Transfer submitted.</strong> Check your bank account for an incoming transfer matching the amount and reference above, then confirm with the customer.
    </div>
    @endif

  </div>

  <!-- Footer -->
  <div class="footer">
    <p><strong>James AutoDrive</strong> · Limerick, Ireland &amp; Liverpool, UK</p>
    <p>This is an automated payment notification. Please do not reply.</p>
  </div>

</div>
</body>
</html>
