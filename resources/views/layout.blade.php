<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Fifteen-crm</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <link rel="shortcut icon" href="{{ URL('images/fifteen_logo.png') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    @vite(['resources/js/app.js']) --}}

</head>

<body>

    @include('cdn')

    </head>

        <div class="wrapper">

            @auth

                <!-- Sidebar  -->
                <nav id="sidebar">
                    <div class="sidebar-header">
                        <h3>Fifteen CRM</h3>
                    </div>

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}"
                                href="/dashboard"><i class="bi bi-grid"></i> Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('clients') || request()->is('clients/*') ? 'active' : '' }}"
                                href="/clients"><i class="bi bi-buildings"></i> Clients</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('deals') || request()->is('deals/*') ? 'active' : '' }}"
                                href="/deals"><i class="bi bi-rocket-takeoff"></i></i> Deals</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('transactions') || request()->is('transactions/*') ? 'active' : '' }}"
                                href="/transactions"><i class="bi bi-layout-text-window-reverse"></i> Transactions </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('clientContacts') || request()->is('clientContacts/*') ? 'active' : '' }}"
                                href="/clientContacts"> <i class="bi bi-people"></i> Contacts</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('websites') || request()->is('websites/*') ? 'active' : '' }}"
                                href="/websites"> <i class="bi bi-globe2"></i> Websites</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('hostingDetails') || request()->is('hostingDetails/*') ? 'active' : '' }}"
                                href="/hostingDetails"> <i class="bi bi-database-gear"></i> Hosting Details</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('technologies') || request()->is('technologies/*') ? 'active' : '' }}"
                                href="/technologies"> <i class="bi bi-code-slash"></i> Technologies</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('serviceLevels') || request()->is('serviceLevels/*') ? 'active' : '' }}"
                                href="/serviceLevels"> <i class="bi bi-boxes"></i> Service Levels</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('activities') || request()->is('activities/*') ? 'active' : '' }}"
                                href="/activities"> <i class="bi bi-clipboard2-data"></i> Activities</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('create_token') ? 'active' : '' }}"
                                href="{{ route('user.create_token') }}"> <i class="bi bi-key"></i> Create Token</a>
                        </li>

                        <li class="nav-item">
                            <form method="POST" action="/logout">
                                @csrf
                                <button class="dropdown-item" type="submit"><i
                                        class="bi bi-box-arrow-right"></i> Logout</button>
                            </form>
                        </li>

                    </ul>

                </nav>

            @endauth

            <!-- Page Content  -->
            <div id="content">

                @auth
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">

                            <button type="button" id="sidebarCollapse" class="btn btn-info">
                                <i class="bi bi-text-left"></i>
                            </button>


                            <div class="dropdown ms-auto">
                                <span class="lead">Welcome, {{ Auth::user()->user_name }} <i class="bi bi-person-circle"></i></span>
                            </div>

                        </div>

                    </nav>

                @endauth

                <div class="container-fluid">
                @yield('content')
                </div>

            </div>
        </div>

    </body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });

        //select2 script
        $('.select2').select2();
    });
</script>
