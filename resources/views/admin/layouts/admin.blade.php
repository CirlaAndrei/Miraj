<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - Miraj</title>
    @vite(['resources/css/custom.css'])
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="admin-sidebar">
            <div class="admin-logo">
                <h2>✨ Miraj Admin</h2>
            </div>

            <nav class="admin-nav">
                <a href="{{ route('admin.dashboard') }}" class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    📊 Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}" class="admin-nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    📦 Produse
                </a>
                <a href="{{ route('admin.orders.index') }}" class="admin-nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    📋 Comenzi
                </a>
                <a href="{{ route('admin.users.index') }}" class="admin-nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    👥 Utilizatori
                </a>
                <a href="{{ route('home') }}" class="admin-nav-item" target="_blank">
                    🌐 Vezi site
                </a>
                <form method="POST" action="{{ route('logout') }}" style="margin-top: auto;">
                    @csrf
                    <button type="submit" class="admin-nav-item logout-btn">🚪 Logout</button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="admin-main">
            <div class="admin-header">
                <h1>@yield('title')</h1>
                <div class="admin-user">
                    <span>{{ Auth::user()->name }}</span>
                </div>
            </div>

            <div class="admin-content">
                @if(session('success'))
                    <div class="alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert-error">{{ session('error') }}</div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <style>
        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: 280px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .admin-logo {
            padding: 30px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }

        .admin-logo h2 {
            font-size: 1.5rem;
            margin: 0;
        }

        .admin-nav {
            flex: 1;
            padding: 20px 0;
            display: flex;
            flex-direction: column;
        }

        .admin-nav-item {
            display: block;
            padding: 15px 25px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .admin-nav-item:hover {
            background: rgba(255,255,255,0.2);
            color: white;
            padding-left: 30px;
        }

        .admin-nav-item.active {
            background: rgba(255,255,255,0.3);
            color: white;
            border-left: 4px solid white;
        }

        .admin-main {
            flex: 1;
            margin-left: 280px;
            background: #f5f5f5;
            min-height: 100vh;
        }

        .admin-header {
            background: white;
            padding: 20px 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-header h1 {
            font-size: 1.8rem;
            color: #333;
            margin: 0;
        }

        .admin-user {
            color: #666;
        }

        .admin-content {
            padding: 30px;
        }

        /* Table Styles */
        .admin-table {
            width: 100%;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .admin-table th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px;
            text-align: left;
        }

        .admin-table td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
        }

        .admin-table tr:hover {
            background: #f9f9f9;
        }

        /* Form Styles */
        .admin-form {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 600px;
        }

        .admin-form .form-group {
            margin-bottom: 20px;
        }

        .admin-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .admin-form input,
        .admin-form select,
        .admin-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            font-size: 1rem;
        }

        .admin-form input:focus,
        .admin-form select:focus,
        .admin-form textarea:focus {
            outline: none;
            border-color: #764ba2;
        }

        /* Buttons */
        .btn-action {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.9rem;
            margin: 0 2px;
        }

        .btn-edit {
            background: #4CAF50;
            color: white;
        }

        .btn-delete {
            background: #f44336;
            color: white;
        }

        .btn-view {
            background: #2196F3;
            color: white;
        }

        .btn-add {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }

        .badge {
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 0.85rem;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }

        .badge-danger {
            background: #f8d7da;
            color: #721c24;
        }

        @media (max-width: 768px) {
            .admin-sidebar {
                width: 200px;
            }

            .admin-main {
                margin-left: 200px;
            }
        }
    </style>
</body>
</html>
