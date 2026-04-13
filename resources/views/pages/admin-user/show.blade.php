@extends('master')

@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">Admin User Details</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">User ID</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $adminUser->id }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Full Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $adminUser->name }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $adminUser->email }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Role</h6>
                        </div>
                        <div class="col-sm-9">
                            <span class="badge {{ $adminUser->role === 'admin' ? 'bg-danger' : 'bg-info' }}">
                                {{ ucfirst($adminUser->role) }}
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Email Verified</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            @if($adminUser->email_verified_at)
                                <span class="badge bg-success">Yes - {{ $adminUser->email_verified_at->format('M d, Y H:i') }}</span>
                            @else
                                <span class="badge bg-warning">Not Verified</span>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Created Date</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $adminUser->created_at->format('M d, Y H:i A') }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Last Updated</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $adminUser->updated_at->format('M d, Y H:i A') }}
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin-users.edit', $adminUser->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin-users.destroy', $adminUser->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                    </form>
                    <a href="{{ route('admin-users.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
