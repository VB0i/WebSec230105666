@extends('layouts.master')

@section('title', 'User Profile')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">User Profile</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <tr>
                            <th width="30%">Name</th>
                            <td>{{$user->name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <th>Roles</th>
                            <td>
                                @foreach($user->roles as $role)
                                    <span class="badge bg-primary me-1">{{$role->name}}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Permissions</th>
                            <td>
                                @if(count($permissions) > 0)
                                    @foreach($permissions as $permission)
                                        <span class="badge bg-success me-1">{{$permission->name}}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">No permissions for a customer</span>
                                @endif
                            </td>
                        </tr>
                    </table>

                    <div class="d-flex justify-content-end mt-3">
                        @if(auth()->user()->hasPermissionTo('edit_users') || auth()->id() == $user->id)
                            <a href="{{route('users_edit', $user->id)}}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit Profile
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Logout Button -->
            <div class="text-center mt-4">
                <form action="{{ route('do_logout') }}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection