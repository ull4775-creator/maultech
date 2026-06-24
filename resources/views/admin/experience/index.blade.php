@extends('layouts.admin')
@section('title', 'Experience')
@section('page-title', 'Experience Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1">All Experience</h5>
        <p class="text-white-50 small mb-0">Manage your work experience</p>
    </div>
    <a href="{{ route('admin.experience.create') }}" class="btn btn-primary-admin">
        <i class="bi bi-plus-lg me-2"></i>Add New
    </a>
</div>

<div class="table-glass">
    <table class="table table-dark table-hover mb-0">
        <thead>
            <tr>
                <th>Position</th>
                <th>Company</th>
                <th>Year</th>
                <th>Status</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($experiences as $experience)
            <tr>
                <td><strong>{{ $experience->position }}</strong></td>
                <td><i class="bi bi-building me-1"></i>{{ $experience->company }}</td>
                <td>
                    <span class="badge badge-glass">
                        {{ $experience->year_start }} - {{ $experience->year_end ?? 'Present' }}
                    </span>
                </td>
                <td>
                    @if($experience->is_current)
                    <span class="badge bg-success"><i class="bi bi-circle-fill me-1 small"></i>Current</span>
                    @else
                    <span class="badge bg-secondary">Past</span>
                    @endif
                </td>
                <td><small class="text-white-50">{{ Str::limit($experience->description, 50) }}</small></td>
                <td>
                    <a href="{{ route('admin.experience.edit', $experience) }}" class="btn btn-sm btn-glass-admin me-1">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('admin.experience.destroy', $experience) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this experience?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-white-50 py-4">
                    No experience yet. <a href="{{ route('admin.experience.create') }}">Add one!</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $experiences->links() }}</div>
@endsection