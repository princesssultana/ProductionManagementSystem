@extends('master')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            @if(Auth::check())
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff&size=64" alt="Avatar" class="rounded-circle me-3" width="64" height="64">
                            <div>
                                <h2 class="mb-0 fw-bold">Welcome, {{ Auth::user()->name }}!</h2>
                                <span class="badge {{ Auth::user()->isAdmin() ? 'bg-success' : 'bg-info' }}">
                                    {{ Auth::user()->isAdmin() ? 'Admin' : 'User' }}
                                </span>
                            </div>
                        </div>
                        <p class="lead text-muted mb-4">
                            {{ Auth::user()->isAdmin() ? 'You have full access to all features and settings.' : 'You can access production orders and medicine management.' }}
                        </p>
                        <div class="row g-4">
                            <div class="col-md-3">
                                <div class="card text-center border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <i class="bi bi-capsule-pill text-primary" style="font-size:2rem;"></i>
                                        </div>
                                        <h6 class="card-title">Medicines</h6>
                                        <p class="fs-4 fw-bold text-primary mb-2">{{ \App\Models\Product::count() }}</p>
                                        <a href="{{ route('products.list') }}" class="btn btn-outline-primary btn-sm">View</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <i class="bi bi-clipboard-data text-info" style="font-size:2rem;"></i>
                                        </div>
                                        <h6 class="card-title">Production Orders</h6>
                                        <p class="fs-4 fw-bold text-info mb-2">{{ \App\Models\Demand::count() }}</p>
                                        <a href="{{ route('demands.index') }}" class="btn btn-outline-info btn-sm">View</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <i class="bi bi-box-seam text-warning" style="font-size:2rem;"></i>
                                        </div>
                                        <h6 class="card-title">Packaging Materials</h6>
                                        <p class="fs-4 fw-bold text-warning mb-2">{{ \App\Models\PackagingMaterial::count() }}</p>
                                        <a href="{{ route('materials.index') }}" class="btn btn-outline-warning btn-sm">View</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center border-0 shadow-sm h-100">
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <i class="bi bi-tags text-success" style="font-size:2rem;"></i>
                                        </div>
                                        <h6 class="card-title">Categories</h6>
                                        <p class="fs-4 fw-bold text-success mb-2">{{ \App\Models\Category::count() }}</p>
                                        <a href="{{ route('category.list') }}" class="btn btn-outline-success btn-sm">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center p-5">
                        <h1 class="fw-bold mb-3">Medicine Production Management System</h1>
                        <p class="lead text-muted mb-4">Manage your medicine production, inventory, and orders efficiently.</p>
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4">Login</a>
                        <!--
                        <a href="{{ route('auth.register') }}" class="btn btn-outline-secondary btn-lg ms-2">Create Account</a>
                        -->
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- Optionally include Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
@endsection