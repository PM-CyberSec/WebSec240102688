@extends('layouts.master')

@section('content')
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">My Profile</h3>
            <a href="{{ route('member.edit') }}" class="btn btn-warning">Edit Profile</a>
        </div>

        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ $user->role }}</p>
        <p><strong>Borrowing Limit:</strong> {{ $borrowLimit }}</p>
        <p><strong>Currently Borrowed:</strong> {{ $currentBorrowCount }}</p>
        <p><strong>Status:</strong> {{ $status }}</p>
    </div>
</div>

<h4 class="mb-3">Borrowed Books On My Account Page</h4>

<div class="row">
    @foreach($borrows as $borrow)
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>{{ $borrow->book->title }}</h5>
                    <p class="mb-1"><strong>Author:</strong> {{ $borrow->book->author }}</p>
                    <p class="mb-0"><strong>Borrowed At:</strong> {{ $borrow->created_at }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection