<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Office Portal - School Management')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body>

    <div class="d-flex">
        <div class="bg-dark text-white vh-100 position-fixed" style="width: 250px; overflow-y: auto;">
            <div class="p-3 border-bottom border-secondary">
                <h5 class="mb-0 fw-bold"><i class="bi bi-building-fill me-2 text-info"></i>Office Portal</h5>
            </div>
            <nav class="nav flex-column p-2">
                <a class="nav-link text-white py-2 {{ request()->routeIs('office.dashboard') ? 'bg-info bg-opacity-25 rounded' : '' }}"
                    href="{{ route('office.dashboard') }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
                <a class="nav-link text-white py-2 {{ request()->routeIs('office.admissions.*') ? 'bg-info bg-opacity-25 rounded' : '' }}"
                    href="{{ route('office.admissions.index') }}">
                    <i class="bi bi-person-plus me-2"></i> Admissions
                </a>
                <hr class="border-secondary">
                <form method="POST" action="{{ route('office.logout') }}">
                    @csrf
                    <button type="submit" class="nav-link text-white py-2 border-0 bg-transparent w-100 text-start">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </button>
                </form>
            </nav>
        </div>

        <div class="flex-grow-1" style="margin-left: 250px;">
            <nav class="navbar navbar-light bg-white shadow-sm px-4">
                <span class="navbar-text fw-semibold">
                    <i class="bi bi-person-circle me-1"></i> {{ Auth::guard('office')->user()->name }}
                </span>
            </nav>
            <div class="p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>