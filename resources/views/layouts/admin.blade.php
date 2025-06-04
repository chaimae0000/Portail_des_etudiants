<!doctype html>
<html lang="en">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons (pour les icônes comme bi-plus-circle) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="Tooplate">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard Template</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/apexcharts.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/tooplate-mini-finance.css') }}" rel="stylesheet">


</head>
<!--

Tooplate 2135 Mini Finance

https://www.tooplate.com/view/2135-mini-finance

Bootstrap 5 Dashboard Admin Template

-->

</head>
@yield('scripts')

<body>

    <header class="navbar sticky-top flex-md-nowrap">
        <div class="col-md-3 col-lg-3 me-0 px-3 fs-6">
           <a class="navbar-brand" href="{{ route('dashboard') }}">
    <img src="{{ asset('images/emsi-logo.jpg') }}" alt="Logo EMSI" style="height: 40px;">
    VIE EMSI
</a>
        </div>

        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="navbar-nav me-lg-2">
            <div class="nav-item text-nowrap d-flex align-items-center">
                <div class="dropdown ps-3">
                    <a class="nav-link dropdown-toggle text-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="navbarLightDropdownMenuLink">
                        <i class="bi-bell"></i>
                        <span class="position-absolute start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-lg-end notifications-block-wrap bg-white shadow" aria-labelledby="navbarLightDropdownMenuLink">
    <small>📨 Messages récents</small>

    @foreach($messages as $message)
    <li class="notifications-block border-bottom pb-2 mb-2">
        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.messages.msgs') }}">
            <div class="notifications-icon-wrap bg-success">
                <i class="notifications-icon bi-check-circle-fill"></i>
            </div>

            <div>
                <span><strong>{{ $message->sender->name }}</strong>: {{ $message->body }}</span>
                <p>{{ $message->created_at->diffForHumans() }}</p>
            </div>
        </a>
    </li>
@endforeach

</ul>
                </div>

                

                <div class="dropdown px-3">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('images/default-user.png') }}" class="profile-image img-fluid" alt="">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-3 shadow-lg border-0" style="min-width: 260px; border-radius: 12px;">
    <li>
        <div class="d-flex align-items-center mb-3">
            <img src="{{ asset('images/default-user.png') }}"
                 class="rounded-circle shadow-sm border me-3"
                 style="width: 55px; height: 55px; object-fit: cover;"
                 alt="Photo Admin">

            <div>
                <div class="fw-bold text-dark">Admin</div>
                <a  class="text-muted small text-decoration-none">admin@gmail.com</a>
            </div>
        </div>
    </li>
    <li><hr class="dropdown-divider"></li>
    <li>
        <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('espaceadmin') }}">
            <i class="bi bi-person-circle text-primary"></i>
            <span>Mon espace</span>
        </a>
    </li>
    <li>
        <a class="dropdown-item d-flex align-items-center gap-2 text-danger" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form-admin').submit();">
            <i class="bi bi-box-arrow-right"></i>
            <span>Déconnexion</span>
        </a>
        <form id="logout-form-admin" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
</ul>

                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-3 d-md-block bg-light sidebar collapse shadow-sm" style="min-height: 100vh;">
            <ul class="nav flex-column py-9 px-9">

                <style>
                    .nav-link.active {
                        transition: background-color 0.3s ease, color 0.3s ease;
                    }

                    .hover-bg:hover {
                        background-color: #f0f0f0;
                        transition: background-color 0.3s ease;
                    }
                </style>

                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center fw-semibold rounded py-2 px-3 hover-bg
                        {{ request()->routeIs('dashboard') ? 'active text-white bg-primary' : 'text-dark' }}"
                       href="{{ route('dashboard') }}">
                        <i class="bi-house-fill me-2 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-primary' }} fs-5"></i>
                        Dashboard
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center fw-semibold rounded py-2 px-3 hover-bg
                        {{ request()->routeIs('posts.store') ? 'active text-white bg-success' : 'text-dark' }}"
                       href="{{ route('posts.store') }}">
                        <i class="bi-pencil-square me-2 {{ request()->routeIs('posts.store') ? 'text-white' : 'text-success' }} fs-5"></i>
                        Posts
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center fw-semibold rounded py-2 px-3 hover-bg
                        {{ request()->routeIs('events.list') ? 'active text-white bg-warning' : 'text-dark' }}"
                       href="{{ route('events.list') }}">
                        <i class="bi-calendar-event me-2 {{ request()->routeIs('events.list') ? 'text-white' : 'text-warning' }} fs-5"></i>
                        Événements
                    </a>
                </li>

                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center fw-semibold rounded py-2 px-3 hover-bg
                        {{ request()->routeIs('espaceadmin') ? 'active text-white bg-info' : 'text-dark' }}"
                       href="{{ route('espaceadmin') }}">
                        <i class="bi-person me-2 {{ request()->routeIs('espaceadmin') ? 'text-white' : 'text-info' }} fs-5"></i>
                        Espace Admin
                    </a>
                </li>

                <li class="nav-item border-top pt-3 mt-3">
                    <a class="nav-link d-flex align-items-center fw-semibold rounded py-2 px-3 hover-bg text-danger"
                       href="{{ route('logout') }}">
                        <i class="bi-box-arrow-left me-2 fs-5"></i>
                        Déconnexion
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</div>

<main class="main-wrapper py-4 px-md-4 border-start" style="margin-left: 12%; /* équivalent à col-2 */">
    
                @yield('content')
            </main>


        </div>
    </div>

    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/apexcharts.min.js"></script>
    <script src="js/custom.js"></script>

    <script type="text/javascript">
        var options = {
            series: [13, 43, 22],
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: ['Balance', 'Expense', 'Credit Loan', ],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#pie-chart"), options);
        chart.render();
    </script>

    <script type="text/javascript">
        var options = {
            series: [{
                name: 'Income',
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
            }, {
                name: 'Expense',
                data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
            }, {
                name: 'Transfer',
                data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            },
            yaxis: {
                title: {
                    text: '$ (thousands)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val + " thousands"
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">


</body>

</html>