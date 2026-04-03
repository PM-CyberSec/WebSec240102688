@extends('layouts.master')
@section('title', 'Multiplication Table')
@section('content')

<div class="card">
    <div class="card-header">Multiplication table of {{$j}}</div>
    <div class="card-body">
    <table>
                @foreach (range(1, 10) as $i)
                <tr><td>{{$i}} * {{$j}}</td><td> = {{ $i * $j }}</td></li>
                @endforeach
            </table>
        </div>
    </div>

@endsection