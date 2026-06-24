@extends('layouts.admin')
@section('title', 'Testimonials')
@section('page-title', 'Testimonials Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1">All Testimonials</h5>
        <p class="text-white-50 small mb-0">Manage client reviews and testimonials</p>
    </div>
    <a href="{{ route('admin.testimonial.create') }}" class="btn btn-primary-admin">
        <i class="bi bi-plus-lg me-2"></i>Add New
    </a>
</div>

<div class="table-glass">
    <table class="table table-dark table-hover mb-0">
        <thead>
            <tr>
                <th>Client</th>
                <th>Position</th>
                <th>Rating</th>
                <th>Message</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($testimonials as $testimonial)
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        @if($testimonial->client_avatar)
                        <img src="{{ asset('storage/'.$testimonial->client_avatar) }}" style="width:40px;height:40px;border-radius:50%;object-fit:cover;margin-right:10px;">
                        @else
                        <div style="width:40px;height:40px;border-radius:50%;background:var(--secondary);display:flex;align-items:center;justify-content:center;margin-right:10px;">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        @endif
                        <strong>{{ $testimonial->client_name }}</strong>
                    </div>
                </td>
                <td class="text-white-50">{{ $testimonial->client_position ?? '-' }}</td>
                <td>
                    @for($i = 0; $i < $testimonial->rating; $i++)
                    <i class="bi bi-star-fill text-warning"></i>
                    @endfor
                </td>
                <td><small class="text-white-50">{{ Str::limit($testimonial->message, 50) }}</small></td>
                <td>
                    @if($testimonial->is_published)
                    <span class="badge bg-success">Published</span>
                    @else
                    <span class="badge bg-secondary">Draft</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.testimonial.edit', $testimonial) }}" class="btn btn-sm btn-glass-admin me-1">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('admin.testimonial.destroy', $testimonial) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this testimonial?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-white-50 py-4">
                    No testimonials yet. <a href="{{ route('admin.testimonial.create') }}">Add one!</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $testimonials->links() }}</div>
@endsection