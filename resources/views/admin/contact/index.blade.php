@extends('layouts.admin')
@section('title', 'Contacts')
@section('page-title', 'Contact Messages')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1">All Messages</h5>
        <p class="text-white-50 small mb-0">Manage contact messages from visitors</p>
    </div>
    <span class="badge badge-glass">
        <i class="bi bi-envelope me-1"></i>{{ $contacts->total() }} Total Messages
    </span>
</div>

<div class="table-glass">
    <table class="table table-dark table-hover mb-0">
        <thead>
            <tr>
                <th>Status</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Service Type</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($contacts as $contact)
            <tr style="{{ !$contact->is_read ? 'background:rgba(230,126,34,0.05);' : '' }}">
                <td>
                    @if($contact->is_read)
                    <span class="badge bg-secondary">Read</span>
                    @else
                    <span class="badge bg-warning"><i class="bi bi-circle-fill me-1 small"></i>New</span>
                    @endif
                </td>
                <td><strong>{{ $contact->name }}</strong></td>
                <td><small>{{ $contact->email }}</small></td>
                <td>{{ Str::limit($contact->subject, 30) }}</td>
                <td>
                    @if($contact->service_type)
                    <span class="badge badge-glass">{{ ucfirst($contact->service_type) }}</span>
                    @else
                    <span class="text-white-50">-</span>
                    @endif
                </td>
                <td><small class="text-white-50">{{ $contact->created_at->diffForHumans() }}</small></td>
                <td>
                    <a href="{{ route('admin.contact.show', $contact) }}" class="btn btn-sm btn-glass-admin me-1">
                        <i class="bi bi-eye"></i>
                    </a>
                    <form action="{{ route('admin.contact.destroy', $contact) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this message?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-white-50 py-4">
                    No messages yet.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $contacts->links() }}</div>
@endsection