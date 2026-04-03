@extends('layouts.master')

@section('content')
<h2 class="mb-4">Roles and Permissions</h2>

@foreach($roles as $role => $permissions)
    <div class="card shadow-sm mb-3">
        <div class="card-header">
            <strong>{{ strtoupper($role) }}</strong>
        </div>
        <div class="card-body">
            @foreach($permissions as $permission)
                <span class="badge bg-primary me-1 mb-1">{{ $permission }}</span>
            @endforeach
        </div>
    </div>
@endforeach
@endsection