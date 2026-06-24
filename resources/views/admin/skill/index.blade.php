@extends('layouts.admin')
@section('title', 'Skills')
@section('page-title', 'Skills Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1">All Skills</h5>
        <p class="text-white-50 small mb-0">Manage your technical and soft skills</p>
    </div>
    <a href="{{ route('admin.skill.create') }}" class="btn btn-primary-admin">
        <i class="bi bi-plus-lg me-2"></i>Add New
    </a>
</div>

<div class="table-glass">
    <table class="table table-dark table-hover mb-0">
        <thead>
            <tr>
                <th>Icon</th>
                <th>Skill Name</th>
                <th>Category</th>
                <th>Level</th>
                <th>Color</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($skills as $skill)
            <tr>
                <td>
                    @if($skill->icon)
                    <i class="bi {{ $skill->icon }}" style="font-size:1.5rem;color:{{ $skill->color ?? 'var(--secondary)' }};"></i>
                    @else
                    <i class="bi bi-lightning-fill" style="font-size:1.5rem;color:{{ $skill->color ?? 'var(--secondary)' }};"></i>
                    @endif
                </td>
                <td><strong>{{ $skill->name }}</strong></td>
                <td>
                    <span class="badge badge-glass">
                        @if($skill->category == 'technical')
                        <i class="bi bi-code-slash me-1"></i>Technical
                        @elseif($skill->category == 'soft')
                        <i class="bi bi-people me-1"></i>Soft Skill
                        @else
                        <i class="bi bi-tools me-1"></i>Tool
                        @endif
                    </span>
                </td>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <div style="width:100px;height:8px;background:rgba(255,255,255,0.1);border-radius:10px;overflow:hidden;">
                            <div style="width:{{ $skill->level }}%;height:100%;background:{{ $skill->color ?? 'var(--secondary)' }};border-radius:10px;"></div>
                        </div>
                        <span class="text-white-50 small">{{ $skill->level }}%</span>
                    </div>
                </td>
                <td>
                    <div style="width:30px;height:30px;background:{{ $skill->color ?? 'var(--secondary)' }};border-radius:6px;border:2px solid rgba(255,255,255,0.2);"></div>
                </td>
                <td>
                    <a href="{{ route('admin.skill.edit', $skill) }}" class="btn btn-sm btn-glass-admin me-1">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('admin.skill.destroy', $skill) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this skill?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-white-50 py-4">
                    No skills yet. <a href="{{ route('admin.skill.create') }}">Add one!</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $skills->links() }}</div>
@endsection