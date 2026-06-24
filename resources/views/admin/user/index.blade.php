@extends('layouts.admin')
@section('title', 'User Management')
@section('page-title', 'User Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1">All Users</h5>
        <p class="text-white-50 small mb-0">Manage admin accounts and passwords</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.change-password') }}" class="btn btn-glass-admin">
            <i class="bi bi-key me-2"></i>Change My Password
        </a>
        <a href="{{ route('admin.user.create') }}" class="btn btn-primary-admin">
            <i class="bi bi-plus-lg me-2"></i>Add New User
        </a>
    </div>
</div>

<div class="table-glass">
    <table class="table table-dark table-hover mb-0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>
                    <div class="d-flex align-items-center">
                        <div style="width:40px;height:40px;border-radius:50%;background:var(--gradient-accent);display:flex;align-items:center;justify-content:center;margin-right:10px;">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <strong>{{ $user->name }}</strong>
                        @if($user->id === auth()->id())
                        <span class="badge bg-success ms-2">You</span>
                        @endif
                    </div>
                </td>
                <td><small>{{ $user->email }}</small></td>
                <td>
                    <span class="badge badge-glass">
                        <i class="bi bi-shield-check me-1"></i>Admin
                    </span>
                </td>
                <td><small class="text-white-50">{{ $user->created_at->diffForHumans() }}</small></td>
                <td>
                    <a href="{{ route('admin.user.edit', $user) }}" class="btn btn-sm btn-glass-admin me-1">
                        <i class="bi bi-pencil"></i>
                    </a>
                    @if($user->id !== auth()->id())
                    <form action="{{ route('admin.user.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this user?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-white-50 py-4">
                    No users found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $users->links() }}</div>
@endsection