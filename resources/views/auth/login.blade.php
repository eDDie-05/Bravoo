<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Sign in · Bravado</title>
<style>
    *{box-sizing:border-box}body{margin:0;font-family:Inter,ui-sans-serif,system-ui,-apple-system,"Segoe UI",sans-serif;color:#172b3a;background:radial-gradient(ellipse at 25% 15%,#e7eed8,transparent 42%),#f4f7f8}.login-wrap{min-height:100vh;display:grid;place-items:center;padding:24px}.login-card{width:min(420px,100%);background:#fff;border:1px solid #e4eaeb;border-radius:18px;padding:32px;box-shadow:0 18px 60px #1a3e4a12}.brand{display:flex;align-items:center;gap:11px}.brand-mark{background:#d8f171;color:#17313a;width:36px;height:36px;border-radius:11px;display:grid;place-items:center;font-weight:850}.brand strong{display:block;font-size:14px;letter-spacing:.02em}.brand small{display:block;color:#95a9ae;margin-top:3px;font-size:11px}.login-card h1{font-size:24px;margin:28px 0 7px}.login-card p{font-size:13px;color:#758a90;margin:0 0 23px}.field{display:grid;gap:7px;margin:15px 0}.field label{font-size:12px;font-weight:650;color:#34505a}.field input{padding:12px;border:1px solid #d9e2e4;border-radius:8px;font:inherit;outline-color:#8ba64e}.check{font-size:12px;color:#637c83;display:flex;align-items:center;gap:8px;margin:16px 0}.button{width:100%;padding:12px;border:0;border-radius:8px;background:#173a46;color:#fff;font-weight:700;cursor:pointer}.error{font-size:12px;color:#a83232}.foot{font-size:11px;color:#95a9ae;text-align:center;margin-top:20px}
</style></head><body><main class="login-wrap"><section class="login-card">
    <div class="brand"><span class="brand-mark">B</span><span><strong>BRAVADO</strong><small>Enterprise platform</small></span></div>
    <h1>Welcome back</h1><p>Sign in to your company workspace.</p>
    <form method="post" action="{{ route('login.store') }}">@csrf
        <div class="field"><label for="email">Work email</label><input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username">@error('email')<span class="error">{{ $message }}</span>@enderror</div>
        <div class="field"><label for="password">Password</label><input id="password" name="password" type="password" required autocomplete="current-password">@error('password')<span class="error">{{ $message }}</span>@enderror</div>
        <label class="check"><input type="checkbox" name="remember"> Keep me signed in</label>
        <button class="button" type="submit">Sign in</button>
    </form>
    <div class="foot">Access is managed by your Bravado administrator.</div>
</section></main></body></html>
