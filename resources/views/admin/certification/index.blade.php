@extends('layouts.admin')
@section('title', 'Certifications')
@section('page-title', 'Certifications Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1">All Certifications</h5>
        <p class="text-white-50 small mb-0">Manage your certificates and achievements</p>
    </div>
    <a href="{{ route('admin.certification.create') }}" class="btn btn-primary-admin">
        <i class="bi bi-plus-lg me-2"></i>Add New
    </a>
</div>

<div class="table-glass">
    <table class="table table-dark table-hover mb-0">
        <thead>
            <tr>
                <th>Icon</th>
                <th>Certification Name</th>
                <th>Issuer</th>
                <th>Year</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($certs as $cert)
            <tr>
                <td>
                    @if($cert->icon)
                    <i class="bi {{ $cert->icon }}" style="font-size:1.5rem;color:var(--secondary);"></i>
                    @else
                    <i class="bi bi-patch-check-fill" style="font-size:1.5rem;color:var(--secondary);"></i>
                    @endif
                </td>
                <td><strong>{{ $cert->name }}</strong></td>
                <td><i class="bi bi-building me-1"></i>{{ $cert->issuer }}</td>
                <td>
                    @if($cert->year)
                    <span class="badge badge-glass">{{ $cert->year }}</span>
                    @else
                    <span class="text-white-50">-</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.certification.edit', $cert) }}" class="btn btn-sm btn-glass-admin me-1">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('admin.certification.destroy', $cert) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this certification?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-white-50 py-4">
                    No certifications yet. <a href="{{ route('admin.certification.create') }}">Add one!</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $certs->links() }}</div>
@endsection