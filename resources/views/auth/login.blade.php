<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin - WorkDesk</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 32px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .login-card h1 {
            margin: 0 0 8px;
            color: #1e293b;
            text-align: center;
        }

        .subtitle {
            margin: 0 0 28px;
            color: #64748b;
            text-align: center;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
        }

        input:focus {
            border-color: #2563eb;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            color: white;
            background: #2563eb;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .error-message {
            margin-bottom: 18px;
            padding: 12px;
            border-radius: 8px;
            color: #b91c1c;
            background: #fee2e2;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <h1>WorkDesk</h1>

        <p class="subtitle">
            Masuk ke halaman administrator
        </p>

        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <button type="submit">
                Masuk
            </button>
        </form>
    </div>
</body>
</html>