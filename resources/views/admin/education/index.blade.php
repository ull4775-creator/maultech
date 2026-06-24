@extends('layouts.admin')
@section('title', 'Education')
@section('page-title', 'Education Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1">All Education</h5>
        <p class="text-white-50 small mb-0">Manage your educational background</p>
    </div>
    <a href="{{ route('admin.education.create') }}" class="btn btn-primary-admin">
        <i class="bi bi-plus-lg me-2"></i>Add New
    </a>
</div>

<div class="table-glass">
    <table class="table table-dark table-hover mb-0">
        <thead>
            <tr>
                <th>Degree</th>
                <th>Institution</th>
                <th>Year</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($educations as $education)
            <tr>
                <td><strong>{{ $education->degree }}</strong></td>
                <td><i class="bi bi-building me-1"></i>{{ $education->institution }}</td>
                <td>
                    <span class="badge badge-glass">
                        {{ $education->year_start }} - {{ $education->year_end ?? 'Present' }}
                    </span>
                </td>
                <td><small class="text-white-50">{{ Str::limit($education->description, 50) }}</small></td>
                <td>
                    <a href="{{ route('admin.education.edit', $education) }}" class="btn btn-sm btn-glass-admin me-1">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('admin.education.destroy', $education) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this education?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-white-50 py-4">
                    No education data yet. <a href="{{ route('admin.education.create') }}">Add one!</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $educations->links() }}</div>
@endsection