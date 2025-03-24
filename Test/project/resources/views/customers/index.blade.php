@extends('layouts.app')

@section('title', 'Manage Customers')

@section('content')
<div class="container">
    <h1>Manage Customers</h1>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Current Credit</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>${{ number_format($customer->credit, 2) }}</td>
                    <td>
                        @can('manage customer credit')
                        <button type="button" class="btn btn-sm btn-primary" 
                                data-bs-toggle="modal" 
                                data-bs-target="#addCreditModal{{ $customer->id }}">
                            Add Credit
                        </button>

                        <!-- Add Credit Modal -->
                        <div class="modal fade" id="addCreditModal{{ $customer->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('customers.add-credit', $customer) }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Credit for {{ $customer->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="amount" class="form-label">Amount</label>
                                                <input type="number" step="0.01" class="form-control" 
                                                       id="amount" name="amount" required min="0.01">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Add Credit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
