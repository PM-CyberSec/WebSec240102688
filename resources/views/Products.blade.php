@extends('layouts.master')
@section('title', 'Products')
@section('content')

<div class="container products-page py-3 px-3">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h1 class="h4 mb-0">Products</h1>
        @auth
            <a href="{{ route('products.create') }}" class="btn btn-sm btn-future">Add new product</a>
        @endauth
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="get" action="{{ route('products.index') }}" class="mb-4">
        <div class="row g-2 align-items-end">
            <div class="col-12 col-sm-6 col-md-4 col-lg">
                <input name="keywords" type="text" class="form-control" placeholder="Search keywords" value="{{ request()->keywords }}" />
            </div>
            <div class="col-6 col-sm-3 col-md-2 col-lg">
                <input name="min_price" type="number" step="any" class="form-control" placeholder="Min price" value="{{ request()->min_price }}" />
            </div>
            <div class="col-6 col-sm-3 col-md-2 col-lg">
                <input name="max_price" type="number" step="any" class="form-control" placeholder="Max price" value="{{ request()->max_price }}" />
            </div>
            <div class="col-6 col-sm-6 col-md-2 col-lg">
                <select name="order_by" class="form-select">
                    <option value="" {{ request()->order_by == '' ? 'selected' : '' }} disabled>Order by</option>
                    <option value="name" {{ request()->order_by == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="price" {{ request()->order_by == 'price' ? 'selected' : '' }}>Price</option>
                </select>
            </div>
            <div class="col-6 col-sm-6 col-md-2 col-lg">
                <select name="order_direction" class="form-select">
                    <option value="" {{ request()->order_direction == '' ? 'selected' : '' }} disabled>Direction</option>
                    <option value="ASC" {{ request()->order_direction == 'ASC' ? 'selected' : '' }}>ASC</option>
                    <option value="DESC" {{ request()->order_direction == 'DESC' ? 'selected' : '' }}>DESC</option>
                </select>
            </div>
            <div class="col-6 col-sm-6 col-md-auto">
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
            <div class="col-6 col-sm-6 col-md-auto">
                <button type="reset" class="btn btn-danger w-100">Reset</button>
            </div>
        </div>
    </form>

    @foreach($products as $product)
        <div class="card product-card mb-3">
            <div class="card-body">
                <div class="row g-3 align-items-start">
                    <div class="col-12 col-md-4 col-lg-3 text-center text-md-start">
                        <img src="{{ asset('images/' . $product->photo) }}" class="img-thumbnail product-card-img" alt="{{ $product->name }}">
                    </div>
                    <div class="col-12 col-md-8 col-lg-9">
                        <h2 class="h5 mb-3">{{ $product->name }}</h2>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm product-detail-table mb-0">
                                <tr><th>Name</th><td>{{ $product->name }}</td></tr>
                                <tr><th>Model</th><td>{{ $product->model }}</td></tr>
                                <tr><th>Code</th><td>{{ $product->code }}</td></tr>
                                <tr><th>Stock</th><td>{{ $product->stock }}</td></tr>
                                <tr><th>Price</th><td>{{ $product->price }}</td></tr>
                                <tr><th>Description</th><td>{{ $product->description }}</td></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="d-flex justify-content-center pt-2">
        {{ $products->links() }}
    </div>
</div>
@endsection
