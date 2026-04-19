<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'College Management System')</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            line-height: 1.6;
        }

        /* NAVBAR */
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 30px;
            font-size: 20px;
            font-weight: 700;
        }

        .navbar-brand .logo {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 0 30px;
        }

        .navbar a {
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .navbar a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .navbar a.active {
            background: rgba(255, 255, 255, 0.3);
        }

        /* LAYOUT */
        .container {
            display: flex;
            min-height: calc(100vh - 70px);
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            min-height: 100%;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 70px;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h3 {
            color: white;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0;
        }

        .sidebar-nav {
            padding: 20px 0;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #ecf0f1;
            padding: 12px 20px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding-left: 30px;
        }

        .sidebar a.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border-left: 4px solid #667eea;
        }

        .sidebar .icon {
            width: 20px;
            text-align: center;
        }

        /* CONTENT */
        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* PAGE TITLE */
        .page-title {
            background: white;
            padding: 20px 30px;
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .page-title::before {
            content: '';
            display: inline-block;
            width: 4px;
            height: 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin-right: 15px;
            border-radius: 2px;
        }

        /* MAIN CONTENT */
        .main-content {
            padding: 30px;
            flex: 1;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        /* FOOTER */
        .footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            text-align: center;
            padding: 25px;
            margin-top: auto;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.1);
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer p {
            margin: 0;
            font-size: 14px;
            opacity: 0.9;
        }

        .footer-links {
            margin-top: 10px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            opacity: 0.8;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            opacity: 1;
            text-decoration: underline;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                position: static;
            }
            
            .navbar {
                flex-direction: column;
                padding: 15px;
            }
            
            .navbar-brand {
                padding: 0;
            }
            
            .navbar-nav {
                padding: 10px 0;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .main-content {
                padding: 20px;
            }
            
            .card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    @include('partials.navbar')

    <div class="container">
        @include('partials.sidebar')
        
        <div class="content">
            <div class="page-title">
                @yield('page-title')
            </div>

            <div class="main-content">
                <div class="card">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')

</body>
</html>
