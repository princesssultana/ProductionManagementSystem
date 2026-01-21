@extends('master')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if(Auth::check())
            <div class="card">
                <div class="card-body">
                    <h2>Welcome to Production Management System</h2>
                    <p class="lead">Hello, <strong>{{ Auth::user()->name }}</strong>!</p>
                    
                    @if(Auth::user()->isAdmin())
                        <div class="alert alert-success">
                            <h5>You are logged in as Admin</h5>
                            <p>You have full access to all features and settings.</p>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <h5>You are logged in as User</h5>
                            <p>You can access production orders and medicine management.</p>
                        </div>
                    @endif

                    <div class="row mt-4">
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h6 class="card-title">Medicines</h6>
                                    <p class="card-text text-primary" style="font-size: 24px;"><strong>{{ \App\Models\Product::count() }}</strong></p>
                                    <a href="{{ route('products.list') }}" class="btn btn-sm btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h6 class="card-title">Production Orders</h6>
                                    <p class="card-text text-info" style="font-size: 24px;"><strong>{{ \App\Models\Demand::count() }}</strong></p>
                                    <a href="{{ route('demands.index') }}" class="btn btn-sm btn-info">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h6 class="card-title">Packaging Materials</h6>
                                    <p class="card-text text-warning" style="font-size: 24px;"><strong>{{ \App\Models\PackagingMaterial::count() }}</strong></p>
                                    <a href="{{ route('materials.index') }}" class="btn btn-sm btn-warning">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h6 class="card-title">Categories</h6>
                                    <p class="card-text text-success" style="font-size: 24px;"><strong>{{ \App\Models\Category::count() }}</strong></p>
                                    <a href="{{ route('category.list') }}" class="btn btn-sm btn-success">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-body text-center">
                    <h2>Welcome to Production Management System</h2>
                    <p class="lead text-muted">Manage your medicine production, inventory, and orders efficiently</p>
                    
                    <hr>
                    
                    <h5 class="mt-4">Please log in to continue</h5>
                    <p class="text-muted mb-3">Sign in with your account to access the system</p>
                    
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-2">Login</a>
                    <!-- <a href="{{ route('auth.register') }}" class="btn btn-secondary btn-lg">Create Account</a> -->
                    
                    <!-- <div class="alert alert-info mt-4">
                        <small>
                            <strong>Demo Credentials:</strong><br>
                            Admin: admin@example.com / admin123456<br>
                            User: user@example.com / user123456
                        </small>
                    </div> -->
                </div>
            </div>
        @endif
    </div>
</div>

@endsection