@extends('layouts.master')
@section('title', 'Purchase History')
@section('content')
<div class="container">
    <h1 class="mb-4">Purchase History</h1>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Purchased Products Table --}}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Purchase Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($purchases as $purchase)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $purchase->product_name }}</td>
                    <td>{{ number_format($purchase->product_price, 2) }}</td>
                    <td>{{ \Carbon\Carbon::parse($purchase->created_at)->format('d-m-Y H:i') }}</td>
                    </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">You haven't purchased any products yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
