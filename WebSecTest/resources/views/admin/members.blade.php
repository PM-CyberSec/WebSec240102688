@extends('layouts.master')

@section('content')
<h2 class="mb-4">Registered Members</h2>

<div class="row">
    @foreach($members as $member)
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5>{{ $member->name }}</h5>
                    <p class="mb-1"><strong>Email:</strong> {{ $member->email }}</p>
                    <p class="mb-0"><strong>Role:</strong> {{ $member->role }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection