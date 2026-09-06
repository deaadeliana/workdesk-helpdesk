<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') - WorkDesk</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: #1e293b;
            background: #f1f5f9;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 240px;
            height: 100vh;
            padding: 24px;
            color: white;
            background: #1e293b;
        }

        .sidebar h2 {
            margin: 0 0 32px;
        }

        .sidebar a {
            display: block;
            margin-bottom: 8px;
            padding: 12px;
            border-radius: 8px;
            color: #cbd5e1;
            text-decoration: none;
        }

        .sidebar a:hover,
        .sidebar a.active {
            color: white;
            background: #2563eb;
        }

        .main-content {
            margin-left: 240px;
            padding: 32px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .header h1 {
            margin: 0 0 6px;
        }

        .header p {
            margin: 0;
            color: #64748b;
        }

        .logout-button {
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            color: white;
            background: #dc2626;
            cursor: pointer;
        }

        .logout-button:hover {
            background: #b91c1c;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .card,
        .content-box {
            padding: 24px;
            border-radius: 12px;
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .card p {
            margin: 0 0 12px;
            color: #64748b;
        }

        .card h2 {
            margin: 0;
            font-size: 32px;
        }

        .content-box {
            margin-top: 28px;
        }

        @media (max-width: 900px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }

            .main-content {
                margin-left: 0;
            }

            .cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .header {
                align-items: flex-start;
                gap: 20px;
                flex-direction: column;
            }

            .cards {
                grid-template-columns: 1fr;
            }
        }
    </style>

    @yield('styles')
</head>

<body>
    <aside class="sidebar">
        <h2>WorkDesk</h2>

        <a
            href="{{ route('admin.dashboard') }}"
            class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
        >
            Dashboard
        </a>

        <a
            href="{{ route('admin.categories.index') }}"
            class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
        >
            Kategori Tiket
        </a>

        <a  
            href="{{ route('admin.users.index') }}"
            class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
        >
            Data Pengguna
        </a>

        <a  href="{{ route('admin.tickets.index') }}"
    class="{{ request()->routeIs('admin.tickets.*') ? 'active' : '' }}">
            Semua Tiket
        </a>
    </aside>

    <main class="main-content">
        <header class="header">
            <div>
                <h1>@yield('page-title')</h1>

                <p>
                    Selamat datang, {{ Auth::user()->name }}
                </p>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout-button">
                    Keluar
                </button>
            </form>
        </header>

        @yield('content')
    </main>
</body>
</html>