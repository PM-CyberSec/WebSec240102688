@extends('layouts.master')

@section('content')
<h2 class="mb-4">My Borrowed Books</h2>

<div class="row">
    @foreach($borrows as $borrow)
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>{{ $borrow->book->title }}</h5>
                    <p class="mb-1"><strong>Author:</strong> {{ $borrow->book->author }}</p>
                    <p class="mb-1"><strong>ISBN:</strong> {{ $borrow->book->isbn }}</p>
                    <p class="mb-0"><strong>Borrowed At:</strong> {{ $borrow->created_at }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection