@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        
        <div class="row">
            <div class="col-12 col-md-8">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel"
                    style="width: 100%; height: 80vh;">
                    <div class="carousel-indicators">
                        @foreach ($images as $index => $image)
                            <button type="button" data-bs-target="#carouselExampleCaptions"
                                data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"
                                aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                                aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner" style="height: 100%;">
                        @foreach ($images as $index => $image)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" style="height: 100%;">
                                <img src="{{ asset('storage/' . $image->image_url) }}" class="d-block w-100 h-100"
                                    alt="Listing Image" style="object-fit: contain; height: 100%;">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-12 col-md-4"> <!-- Additional content taking 30% on larger screens -->
                <div class="modal-text" style="height: 80vh; overflow-y: auto;">
                    <h5>Headline</h5>
                    <p>{{ $listing->headline }}</p>
                    <h5>Description</h5>
                    <p>{{ $listing->description }}</p>
                    <h5>Quantity</h5>
                    <p>{{ $listing->quantity }}</p>
                    <h5>Category</h5>
                    <p>{{ $listing->category->name }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
<div class="carousel-caption d-none d-md-block">

</div>
@section('customjs')
@endsection
