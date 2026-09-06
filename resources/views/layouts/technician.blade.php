<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Teknisi') - WorkDesk
    </title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            color: #172b4d;
            background: #f1f5f9;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 270px;
            padding: 30px;
            color: white;
            background: #1e293b;
        }

        .sidebar h2 {
            margin: 0 0 40px;
            font-size: 30px;
        }

        .sidebar a {
            display: block;
            margin-bottom: 10px;
            padding: 15px;
            color: white;
            border-radius: 10px;
            text-decoration: none;
            font-size: 18px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #2563eb;
        }

        .main-content {
            min-height: 100vh;
            margin-left: 270px;
            padding: 38px 40px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .welcome-text {
            color: #64748b;
            font-size: 18px;
        }

        .logout-btn {
            padding: 12px 20px;
            color: white;
            background: #dc2626;
            border: none;
            border-radius: 9px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #b91c1c;
        }

        .page-title {
            margin-bottom: 8px;
            font-size: 38px;
        }

        .page-description {
            margin-top: 0;
            color: #64748b;
        }

        @media (max-width: 800px) {
            .sidebar {
                position: static;
                width: 100%;
            }

            .main-content {
                margin-left: 0;
                padding: 25px;
            }

            .topbar {
                gap: 20px;
                align-items: flex-start;
            }
        }
    </style>

    @yield('styles')
</head>

<body>
    <aside class="sidebar">
        <h2>WorkDesk</h2>

        <a
            href="{{ route('technician.dashboard') }}"
            class="{{ request()->routeIs('technician.dashboard') ? 'active' : '' }}"
        >
            Dashboard
        </a>

        <a
            href="{{ route('technician.tickets.index') }}"
            class="{{ request()->routeIs('technician.tickets.*') ? 'active' : '' }}"
        >
            Tiket Ditugaskan
        </a>
    </aside>

    <main class="main-content">
        <div class="topbar">
            <div class="welcome-text">
                Selamat datang, {{ auth()->user()->name }}
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout-btn">
                    Keluar
                </button>
            </form>
        </div>

        @yield('content')
    </main>
</body>
</html>