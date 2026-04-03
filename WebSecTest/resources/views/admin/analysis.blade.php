@extends('layouts.master')

@section('content')
<h2 class="mb-4 section-title">System Analysis</h2>

<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card glass-card shadow-sm">
            <div class="card-body">
                <h5>Total Books</h5>
                <h2>{{ $totalBooks }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card glass-card shadow-sm">
            <div class="card-body">
                <h5>Total Members</h5>
                <h2>{{ $totalMembers }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card glass-card shadow-sm">
            <div class="card-body">
                <h5>Total Librarians</h5>
                <h2>{{ $totalLibrarians }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card glass-card shadow-sm">
            <div class="card-body">
                <h5>Total Borrows</h5>
                <h2>{{ $totalBorrows }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card glass-card shadow-sm">
            <div class="card-body">
                <h5>Available Books</h5>
                <h2>{{ $availableBooks }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card glass-card shadow-sm">
            <div class="card-body">
                <h5>Unavailable Books</h5>
                <h2>{{ $unavailableBooks }}</h2>
            </div>
        </div>
    </div>
</div>
@endsection