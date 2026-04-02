<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Login - School Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg border-0" style="width:100%;max-width:440px;">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:64px;height:64px;">
                        <i class="bi bi-people-fill fs-2 text-info"></i>
                    </div>
                    <h4 class="fw-bold">Parent Portal</h4>
                    <p class="text-muted small">Sign in to view your child's progress</p>
                </div>

                @if($errors->any())
                <div class="alert alert-danger py-2">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('parent.login.submit') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-info w-100 fw-semibold text-white">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Login
                    </button>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('home') }}" class="text-muted small"><i class="bi bi-arrow-left me-1"></i>Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
