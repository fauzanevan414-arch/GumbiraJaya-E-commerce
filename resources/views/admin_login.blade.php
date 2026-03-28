<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .box {
            background: #fff;
            padding: 36px 32px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 360px;
        }
        h2 {
            font-size: 1.2rem;
            margin-bottom: 24px;
            color: #1a1a2e;
            text-align: center;
        }
        label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #555;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 0.875rem;
            margin-bottom: 16px;
            outline: none;
        }
        input:focus { border-color: #f39c12; }
        button {
            width: 100%;
            padding: 12px;
            background: #f39c12;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
        }
        button:hover { background: #d68910; }
        .error {
            background: #fdf0f0;
            color: #e74c3c;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 16px;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>🔐 Admin Login</h2>

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password admin" required autofocus>
            <button type="submit">Masuk</button>
        </form>
    </div>
</body>
</html>