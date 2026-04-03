@extends('layouts.master')

@section('content')
<h2 class="mb-4">Librarians</h2>

<div class="row">
    @forelse($librarians as $librarian)
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>{{ $librarian->name }}</h5>
                    <p class="mb-1"><strong>Email:</strong> {{ $librarian->email }}</p>
                    <p class="mb-0"><strong>Role:</strong> {{ $librarian->role }}</p>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">
                No librarians found.
            </div>
        </div>
    @endforelse
</div>
@endsection