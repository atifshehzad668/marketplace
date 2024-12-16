@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12 text-center">
                <h2 style="color: rgb(105, 108, 255); font-family:georgia; font-size: 1.75rem; letter-spacing: -0.5px;">
                    Leads</h2>
            </div>
        </div>
        <div class="row g-3 mt-5 ml-3"> {{-- Use Bootstrap's gutter classes for spacing --}}
            <div class="col-md-3">
                <div class="card text-center justify-content-center" style="height: 200px; width: 250px; border-radius:20px;">
                    <h3>Pending (<span style="color: red">{{ $pendingCount }}</span>)</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center justify-content-center"
                    style="height: 200px; width: 250px; border-radius:20px;">
                    <h3>Active (<span style="color: red">{{ $activeCount }}</span>)</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center justify-content-center"
                    style="height: 200px; width: 250px; border-radius:20px;">
                    <h3>Closed (<span style="color: red">{{ $closedCount }}</span>)</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center justify-content-center"
                    style="height: 200px; width: 250px; border-radius:20px;">
                    <h3>Not Closed (<span style="color: red">{{ $notClosedCount }}</span>)</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
