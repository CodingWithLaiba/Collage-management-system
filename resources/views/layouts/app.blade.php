<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>

    <style>
        body {
            margin:0;
            font-family: Arial;
            background:#f4f6f9;
        }

        /* NAVBAR */
        .navbar {
            background:#2c3e50;
            color:white;
            padding:15px 20px;
            display:flex;
            justify-content:space-between;
        }

        .navbar a {
            color:white;
            margin-right:15px;
            text-decoration:none;
        }

        .navbar a:hover {
            text-decoration:underline;
        }

        /* LAYOUT */
        .container {
            display:flex;
            height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width:220px;
            background:#1a252f;
            min-height:100vh;
            padding-top:20px;
        }

        .sidebar a {
            display:block;
            color:#ccc;
            padding:12px 20px;
            text-decoration:none;
        }

        .sidebar a:hover {
            background:#34495e;
            color:white;
        }

        /* CONTENT */
        .content {
            flex:1;
        }

        /* PAGE TITLE */
        .page-title {
            background:white;
            padding:15px;
            font-size:20px;
            font-weight:bold;
            border-bottom:1px solid #ddd;
        }

        /* MAIN CONTENT */
        .main-content {
            padding:20px;
        }

        .card {
            background:white;
            padding:20px;
            border-radius:8px;
            box-shadow:0 2px 5px rgba(0,0,0,0.1);
        }

        /* FOOTER */
        .footer {
            background:#2c3e50;
            color:white;
            text-align:center;
            padding:10px;
            margin-top:20px;
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
