<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
  <title>Admin Login – James AutoDrive</title>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { min-height: 100vh; display: flex; align-items: center; justify-content: center;
           background: linear-gradient(135deg, #0a0a0a 0%, #1a1a26 100%); font-family: 'Segoe UI', Arial, sans-serif; }
    .card { background: #fff; border-radius: 16px; padding: 48px 40px; width: 100%; max-width: 400px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4); }
    .logo { text-align: center; margin-bottom: 32px; }
    .logo h1 { font-size: 22px; font-weight: 900; color: #1a1a26; letter-spacing: -0.02em; }
    .logo h1 span { color: #d4a017; }
    .logo p { font-size: 12px; color: #9ca3af; margin-top: 4px; }
    label { display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.06em; }
    input[type="password"] { width: 100%; padding: 12px 16px; border: 1.5px solid #e5e7eb; border-radius: 8px;
                              font-size: 15px; outline: none; transition: border-color .2s; }
    input[type="password"]:focus { border-color: #d4a017; }
    .error { color: #dc2626; font-size: 13px; margin-top: 6px; }
    button { width: 100%; margin-top: 24px; padding: 13px; background: #d4a017; color: #fff;
             border: none; border-radius: 8px; font-size: 15px; font-weight: 700; cursor: pointer;
             transition: background .2s; }
    button:hover { background: #b8881a; }
  </style>
</head>
<body>
  <div class="card">
    <div class="logo">
      <h1>JAMES <span>AUTO</span>DRIVE</h1>
      <p>Admin Panel — Payments Database</p>
    </div>
    <form method="POST" action="{{ route('admin.login') }}">
      @csrf
      <label for="password">Admin Password</label>
      <input type="password" id="password" name="password" placeholder="Enter password" autofocus/>
      @error('password')
        <p class="error">{{ $message }}</p>
      @enderror
      <button type="submit">Sign In</button>
    </form>
  </div>
</body>
</html>
