@extends('layouts.master')
@section('title', 'User Profile')
@section('content')
<div class="row">
    <div class="m-4 col-sm-6">
        <table class="table table-striped">
            <tr>
                <th>Name</th><td>{{$user->name}}</td>
            </tr>
            <tr>
                <th>Email</th><td>{{$user->email}}</td>
            </tr>
            <tr>
                <th>Roles</th>
                <td>
                    @foreach($user->roles as $role)
                        <span class="badge bg-primary">{{$role->name}}</span>
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>Credit Balance</th>
                <td>
                    <span class="badge bg-primary">${{ $user->credit }}</span>

                    @if(auth()->user()->hasRole('Employee') && $user->hasRole('Customer'))
                    <form method="POST" action="{{ route('users.addCredit', $user->id) }}" class="mt-2">
                        @csrf
                        <div class="input-group">
                            <input type="number" name="amount" step="0.01" min="0.01" class="form-control" placeholder="Amount" required>
                            <button type="submit" class="btn btn-sm btn-success">Add Credit</button>
                        </div>
                    </form>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Permissions</th>
                <td>
                    @foreach($permissions as $permission)
                        <span class="badge bg-success">{{$permission->display_name}}</span>
                    @endforeach
                </td>
            </tr>
        </table>

        <div class="row">
            <div class="col col-6">
            @if(auth()->user()->hasRole('Employee') || auth()->user()->hasRole('Admin'))
                <a href="{{ route('customers.list') }}" class="btn btn-primary">Show Customers</a>
            @endif
            </div>
            @if(auth()->user()->hasPermissionTo('admin_users')||auth()->id()==$user->id)
            <div class="col col-4">
                <a class="btn btn-primary" href='{{route('edit_password', $user->id)}}'>Change Password</a>
            </div>
            @else
            <div class="col col-4">
            </div>
            @endif
            @if(auth()->user()->hasPermissionTo('edit_users')||auth()->id()==$user->id)
            <div class="col col-2">
                <a href="{{route('users_edit', $user->id)}}" class="btn btn-success form-control">Edit</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection