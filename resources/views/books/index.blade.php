@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <h2 class="section-title mb-0">Library Catalogue</h2>
    <form method="GET" action="{{ route('books.index') }}" class="d-flex align-items-center">
    <input
        type="text"
        name="search"
        class="form-control search-input me-2"
        placeholder="Search by title, author, or ISBN"
        value="{{ request('search') }}"
    >
    <button type="submit" class="search-btn">
        Search
    </button>
    </form>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif

<div class="row">
    @forelse($books as $book)
        <div class="col-md-6 mb-3">
            <div class="card glass-card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->title }}</h5>

                    <p class="mb-1"><strong>Author:</strong> {{ $book->author }}</p>
                    <p class="mb-1"><strong>ISBN:</strong> {{ $book->isbn }}</p>
                    <p class="mb-3"><strong>Copies:</strong> {{ $book->copies }}</p>

                    @auth
                        @if(auth()->user()->role === 'member')
                            <form method="POST" action="{{ route('borrow', $book->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-future">Borrow</button>
                            </form>
                        @endif

                        @if(in_array(auth()->user()->role, ['admin', 'librarian']))
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning-soft">Edit</a>

                            <form method="POST" action="{{ route('books.delete', $book->id) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger-soft">Delete</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">
                No books found.
            </div>
        </div>
    @endforelse
</div>
@endsection