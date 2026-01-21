@extends('master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4">Production Management System</h2>
                    <h5 class="text-center text-muted mb-4">Login to Your Account</h5>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('auth.login') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
                    </form>

                    <hr>

                    <p class="text-center text-muted mb-0">
                        Don't have an account? <a href="{{ route('auth.register') }}" class="text-decoration-none">Register here</a>
                    </p>

                    <div class="alert alert-info mt-3">
                        <small>
                            <strong>Demo Credentials:</strong><br>
                            Admin: admin@example.com / admin123456<br>
                            User: user@example.com / user123456
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
