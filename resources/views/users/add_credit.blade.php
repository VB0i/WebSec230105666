@extends('layouts.master')

@section('title', 'Add Credit')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Add Credit to {{ $user->name }}</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <p>Current Credit: <strong>{{ number_format($user->credit, 2) }}</strong></p>
            </div>
            
            <form action="{{ route('users.add_credit', $user->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount to Add</label>
                    <input type="number" step="0.01" min="0.01" class="form-control" id="amount" name="amount" required>
                </div>
                
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('users.list') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">OK</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection