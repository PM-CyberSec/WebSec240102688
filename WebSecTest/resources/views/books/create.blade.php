@extends('layouts.master')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="mb-4">Add Book</h3>

                <form method="POST" action="{{ route('books.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Author</label>
                        <input type="text" name="author" class="form-control" value="{{ old('author') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">ISBN</label>
                        <input type="text" name="isbn" class="form-control" value="{{ old('isbn') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Copies</label>
                        <input type="number" name="copies" class="form-control" value="{{ old('copies') }}">
                    </div>

                    <button type="submit" class="btn btn-success w-100">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection