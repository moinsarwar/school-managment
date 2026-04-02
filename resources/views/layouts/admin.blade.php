<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - School Management')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    @stack('styles')
</head>

<body>

    <div class="d-flex">
        {{-- Sidebar --}}
        <div class="bg-dark text-white vh-100 position-fixed" style="width: 250px; overflow-y: auto;">
            <div class="p-3 border-bottom border-secondary">
                <h5 class="mb-0 fw-bold"><i class="bi bi-shield-lock-fill me-2 text-danger"></i>Admin Panel</h5>
            </div>
            <nav class="nav flex-column p-2">
                <a class="nav-link text-white py-2 {{ request()->routeIs('admin.dashboard') ? 'bg-danger bg-opacity-25 rounded' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>

                <div class="nav-link text-secondary small fw-bold pt-3 pb-1 px-2 text-uppercase" style="font-size:.7rem;letter-spacing:.08em;">Academic</div>
                <a class="nav-link text-white py-2 {{ request()->routeIs('admin.classes.*') ? 'bg-danger bg-opacity-25 rounded' : '' }}"
                    href="{{ route('admin.classes.index') }}">
                    <i class="bi bi-building me-2"></i> Classes
                </a>
                <a class="nav-link text-white py-2 {{ request()->routeIs('admin.sections.*') ? 'bg-danger bg-opacity-25 rounded' : '' }}"
                    href="{{ route('admin.sections.index') }}">
                    <i class="bi bi-grid me-2"></i> Sections
                </a>
                <a class="nav-link text-white py-2 {{ request()->routeIs('admin.subjects.*') ? 'bg-danger bg-opacity-25 rounded' : '' }}"
                    href="{{ route('admin.subjects.index') }}">
                    <i class="bi bi-book me-2"></i> Subjects
                </a>
                <a class="nav-link text-white py-2 {{ request()->routeIs('admin.timetables.*') ? 'bg-danger bg-opacity-25 rounded' : '' }}"
                    href="{{ route('admin.timetables.index') }}">
                    <i class="bi bi-calendar3-week me-2"></i> Timetable
                </a>
                <a class="nav-link text-white py-2 {{ request()->routeIs('admin.exams.*') ? 'bg-danger bg-opacity-25 rounded' : '' }}"
                    href="{{ route('admin.exams.index') }}">
                    <i class="bi bi-file-earmark-text me-2"></i> Exams
                </a>
                <a class="nav-link text-white py-2 {{ request()->routeIs('admin.attendance.*') ? 'bg-danger bg-opacity-25 rounded' : '' }}"
                    href="{{ route('admin.attendance.index') }}">
                    <i class="bi bi-clipboard-check me-2"></i> Attendance
                </a>
                <a class="nav-link text-white py-2 {{ request()->routeIs('admin.promotions.*') ? 'bg-danger bg-opacity-25 rounded' : '' }}"
                    href="{{ route('admin.promotions.index') }}">
                    <i class="bi bi-arrow-up-circle me-2"></i> Promotions
                </a>

                <div class="nav-link text-secondary small fw-bold pt-3 pb-1 px-2 text-uppercase" style="font-size:.7rem;letter-spacing:.08em;">People</div>
                <a class="nav-link text-white py-2 {{ request()->routeIs('admin.teachers.*') ? 'bg-danger bg-opacity-25 rounded' : '' }}"
                    href="{{ route('admin.teachers.index') }}">
                    <i class="bi bi-person-workspace me-2"></i> Teachers
                </a>
                <a class="nav-link text-white py-2 {{ request()->routeIs('admin.students.*') ? 'bg-danger bg-opacity-25 rounded' : '' }}"
                    href="{{ route('admin.students.index') }}">
                    <i class="bi bi-backpack me-2"></i> Students
                </a>
                <a class="nav-link text-white py-2 {{ request()->routeIs('admin.users.*') ? 'bg-danger bg-opacity-25 rounded' : '' }}"
                    href="{{ route('admin.users.index') }}">
                    <i class="bi bi-people me-2"></i> User Management
                </a>

                <div class="nav-link text-secondary small fw-bold pt-3 pb-1 px-2 text-uppercase" style="font-size:.7rem;letter-spacing:.08em;">Finance</div>
                <a class="nav-link text-white py-2 {{ request()->routeIs('admin.fee-structures.*') ? 'bg-danger bg-opacity-25 rounded' : '' }}"
                    href="{{ route('admin.fee-structures.index') }}">
                    <i class="bi bi-currency-dollar me-2"></i> Fee Structures
                </a>
                <a class="nav-link text-white py-2 {{ request()->routeIs('admin.fee-payments.*') ? 'bg-danger bg-opacity-25 rounded' : '' }}"
                    href="{{ route('admin.fee-payments.index') }}">
                    <i class="bi bi-cash-stack me-2"></i> Fee Payments
                </a>
                <a class="nav-link text-white py-2 {{ request()->routeIs('admin.fee-payments.defaulters') ? 'bg-danger bg-opacity-25 rounded' : '' }}"
                    href="{{ route('admin.fee-payments.defaulters') }}">
                    <i class="bi bi-exclamation-triangle me-2"></i> Fee Defaulters
                </a>

                <div class="nav-link text-secondary small fw-bold pt-3 pb-1 px-2 text-uppercase" style="font-size:.7rem;letter-spacing:.08em;">Administration</div>
                <a class="nav-link text-white py-2 {{ request()->routeIs('admin.leaves.*') ? 'bg-danger bg-opacity-25 rounded' : '' }}"
                    href="{{ route('admin.leaves.index') }}">
                    <i class="bi bi-calendar-x me-2"></i> Leave Requests
                </a>
                <a class="nav-link text-white py-2 {{ request()->routeIs('admin.notices.*') ? 'bg-danger bg-opacity-25 rounded' : '' }}"
                    href="{{ route('admin.notices.index') }}">
                    <i class="bi bi-megaphone me-2"></i> Notice Board
                </a>
                <a class="nav-link text-white py-2 {{ request()->routeIs('admin.events.*') ? 'bg-danger bg-opacity-25 rounded' : '' }}"
                    href="{{ route('admin.events.index') }}">
                    <i class="bi bi-calendar-event me-2"></i> Events
                </a>

                <hr class="border-secondary">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="nav-link text-white py-2 border-0 bg-transparent w-100 text-start">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </button>
                </form>
            </nav>
        </div>

        {{-- Main Content --}}
        <div class="flex-grow-1" style="margin-left: 250px;">
            <nav class="navbar navbar-light bg-white shadow-sm px-4">
                <span class="navbar-text fw-semibold">
                    <i class="bi bi-person-circle me-1"></i> {{ Auth::guard('admin')->user()->name }}
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.dt-table').DataTable({
                pageLength: 15,
                language: { search: 'Search:', lengthMenu: 'Show _MENU_ entries' },
                responsive: true
            });
        });
    </script>
    @stack('scripts')
</body>

</html>