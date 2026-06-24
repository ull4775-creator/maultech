@extends('layouts.admin')
@section('title', 'Portfolio')
@section('page-title', 'Portfolio Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1">All Portfolios</h5>
        <p class="text-white-50 small mb-0">Manage your portfolio projects</p>
    </div>
    <a href="{{ route('admin.portfolio.create') }}" class="btn btn-primary-admin">
        <i class="bi bi-plus-lg me-2"></i>Add New
    </a>
</div>

<div class="table-glass">
    <table class="table table-dark table-hover mb-0">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Views</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($portfolios as $portfolio)
            <tr>
                <td>
                    @if($portfolio->image)
                    <img src="{{ asset('storage/'.$portfolio->image) }}" style="width:60px;height:40px;object-fit:cover;border-radius:8px;">
                    @else
                    <div style="width:60px;height:40px;background:var(--secondary);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-image small"></i>
                    </div>
                    @endif
                </td>
                <td>
                    <strong>{{ $portfolio->title }}</strong>
                    @if($portfolio->is_featured)<span class="badge bg-warning ms-1">Featured</span>@endif
                </td>
                <td><span class="badge badge-glass">{{ ucfirst($portfolio->category) }}</span></td>
                <td>{{ number_format($portfolio->views) }}</td>
                <td>
                    @if($portfolio->is_published)
                    <span class="badge bg-success">Published</span>
                    @else
                    <span class="badge bg-secondary">Draft</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.portfolio.edit', $portfolio) }}" class="btn btn-sm btn-glass-admin me-1"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('admin.portfolio.destroy', $portfolio) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this portfolio?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center text-white-50 py-4">No portfolios yet. <a href="{{ route('admin.portfolio.create') }}">Create one!</a></td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $portfolios->links() }}</div>
@endsection