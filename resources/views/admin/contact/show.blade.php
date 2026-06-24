@extends('layouts.admin')
@section('title', 'Message Detail')
@section('page-title', 'Message Detail')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="stat-card mb-4">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h5 class="mb-1">{{ $contact->subject ?? 'No Subject' }}</h5>
                    <small class="text-white-50">
                        <i class="bi bi-calendar me-1"></i>{{ $contact->created_at->format('d M Y, H:i') }}
                    </small>
                </div>
                @if($contact->is_read)
                <span class="badge bg-secondary">Read</span>
                @else
                <span class="badge bg-warning">New</span>
                @endif
            </div>

            <div class="mb-4 p-3" style="background:rgba(255,255,255,0.03);border-radius:10px;">
                <div class="row g-3">
                    <div class="col-md-6">
                        <small class="text-white-50">From:</small>
                        <h6 class="mb-0">{{ $contact->name }}</h6>
                    </div>
                    <div class="col-md-6">
                        <small class="text-white-50">Email:</small>
                        <h6 class="mb-0"><a href="mailto:{{ $contact->email }}" class="text-info">{{ $contact->email }}</a></h6>
                    </div>
                    @if($contact->phone)
                    <div class="col-md-6">
                        <small class="text-white-50">Phone:</small>
                        <h6 class="mb-0">{{ $contact->phone }}</h6>
                    </div>
                    @endif
                    @if($contact->service_type)
                    <div class="col-md-6">
                        <small class="text-white-50">Service Type:</small>
                        <h6 class="mb-0"><span class="badge badge-glass">{{ ucfirst($contact->service_type) }}</span></h6>
                    </div>
                    @endif
                </div>
            </div>

            <div class="mb-4">
                <h6 class="mb-2"><i class="bi bi-chat-left-text me-2"></i>Message:</h6>
                <div class="p-3" style="background:rgba(255,255,255,0.03);border-radius:10px;border-left:3px solid var(--accent);">
                    {!! nl2br(e($contact->message)) !!}
                </div>
            </div>

            @if($contact->reply)
            <div class="mb-4">
                <h6 class="mb-2" style="color:var(--accent);"><i class="bi bi-reply me-2"></i>Your Reply:</h6>
                <div class="p-3" style="background:rgba(230,126,34,0.1);border-radius:10px;border-left:3px solid var(--accent);">
                    {!! nl2br(e($contact->reply)) !!}
                    <div class="mt-2">
                        <small class="text-white-50">
                            <i class="bi bi-clock me-1"></i>Replied at: {{ $contact->replied_at->format('d M Y, H:i') }}
                        </small>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Reply Form -->
        <div class="stat-card">
            <h5 class="mb-3"><i class="bi bi-reply me-2"></i>Reply Message</h5>
            <form action="{{ route('admin.contact.reply', $contact) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <textarea name="reply" class="form-control form-control-admin" rows="5" required placeholder="Type your reply here...">{{ old('reply', $contact->reply) }}</textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary-admin">
                        <i class="bi bi-send me-2"></i>Send Reply
                    </button>
                    <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="btn btn-glass-admin" target="_blank">
                        <i class="bi bi-envelope me-2"></i>Open in Email Client
                    </a>
                    <a href="{{ route('admin.contact.index') }}" class="btn btn-glass-admin ms-auto">
                        <i class="bi bi-arrow-left me-2"></i>Back
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="stat-card">
            <h6 class="mb-3"><i class="bi bi-info-circle me-2"></i>Quick Actions</h6>
            <div class="d-grid gap-2">
                <a href="mailto:{{ $contact->email }}" class="btn btn-glass-admin">
                    <i class="bi bi-envelope me-2"></i>Send Email
                </a>
                @if($contact->phone)
                <a href="tel:{{ $contact->phone }}" class="btn btn-glass-admin">
                    <i class="bi bi-telephone me-2"></i>Call Phone
                </a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->phone) }}" class="btn btn-glass-admin" target="_blank">
                    <i class="bi bi-whatsapp me-2"></i>WhatsApp
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection