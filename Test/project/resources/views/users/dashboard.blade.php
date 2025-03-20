@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0"><i class="fa-solid fa-gauge"></i> Dashboard</h3>
                    
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card bg-info text-white h-100">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-users"></i> Total Users</h5>
                                    <h2 class="card-text display-4">{{ \App\Models\User::count() }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-success text-white h-100">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><i class="fas fa-box"></i> Total Products</h5>
                                    <h2 class="card-text display-4">{{ \App\Models\Product::count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Users Management Card -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-users-cog"></i> User Management</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(\App\Models\User::all() as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @foreach($user->roles as $role)
                                                    <span class="badge bg-info">{{ $role->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                @can('edit_users')
                                                <a href="{{ route('users_edit', $user->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                @endcan
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Products Management Card -->
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="fas fa-box"></i> Product Management</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead class="table-success">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(\App\Models\Product::all() as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>${{ number_format($product->price, 2) }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>
                                            @can('edit_products')
                                                <a href="{{ route('products_edit', $product->id) }}" class="btn btn-sm btn-success">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                            @endcan
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <form action="{{ route('do_logout') }}" method="POST" class="d-inline">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-danger btn-lg">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    margin-bottom: 1.5rem;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}

.card-header {
    padding: 1rem 1.35rem;
    margin-bottom: 0;
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}

.table th {
    font-weight: 600;
}

.badge {
    padding: 0.5em 1em;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    margin: 0 0.2rem;
}

.table-hover tbody tr:hover {
    background-color: rgba(0,0,0,.075);
}

.display-4 {
    font-size: 2.5rem;
    font-weight: 300;
    line-height: 1.2;
}

.fas {
    margin-right: 0.5rem;
}
</style>
@endsection
