@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-3">

        </div>
        <div class="row mb-3">
            <!-- City Dropdown -->
            <div class="col-md-3 mb-3">
                <label class="form-label">City</label>
                <select class="form-control" name="city_id" id="city-select">
                    <option value="">Select city</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->city_name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Region Dropdown -->
            <div class="col-md-3 mb-3">
                <label class="form-label">Region</label>
                <select class="form-control" name="region_id" id="region-select">
                    <option value="">Select region</option>
                    {{-- @foreach ($regions as $region)
                        <option value="{{ $region->id }}">{{ $region->region_name }}</option>
                    @endforeach --}}
                </select>

            </div>

            <!-- Additional Field Placeholder (Example: Country) -->
            <div class="col-md-3 mb-3">
                <label class="form-label">Search</label>

                <input type="text" class="form-control" name="search" id="listing_key" placeholder="Search..." />
            </div>
            <div class="col-md-3 mb-3 mt-6">
                <a href="{{ route('market.place') }}" class="btn btn-primary">Reset</a>
            </div>
        </div>



        <!-- Basic Layout -->
        <div class="row" id="listing-container">
            @foreach ($listings as $listing)
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        @if ($listing->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $listing->images->first()->image_url) }}"
                                class="card-img-top custom-img" alt="Main Image">
                        @else
                            <span>No image</span>
                        @endif
                        <h5 class="card-title">{{ $listing->headline }}</h5>
                        <p class="card-text">{{ $listing->description }}</p>
                        <div class="d-flex justify-content-between mt-2 py-1 ml-2">
                            <a href="{{ route('listing.view', $listing->id) }}" class="btn btn-primary">View</a>
                            <a href="{{ route('orders.buy', $listing->id) }}" class="btn btn-primary">Buy</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <style>
            .custom-img {
                width: 100%;
                height: 70%;
                object-fit: contain;

            }

            .card {
                margin-left: 10px;
            }
        </style>


    </div>
    @if (Session::has('success'))
        <script>
            swal("Good job!", "{{ Session::get('success') }}", "success");
        </script>
    @endif
@endsection

@section('customjs')
    <script>
        document.getElementById('city-select').addEventListener('change', function() {
            let cityId = this.value;
            let regionSelect = document.getElementById('region-select');

            // Clear previous options
            regionSelect.innerHTML = '<option value="">Select region</option>';

            if (cityId) {
                fetch(`/api/regions?city_id=${cityId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(region => {
                            let option = document.createElement('option');
                            option.value = region.id;
                            option.textContent = region.region_name;
                            regionSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching regions:', error));
            }
        });
        $("#city-select, #region-select").on('change', function() {
            var cityId = $("#city-select").val();
            var regionId = $("#region-select").val();

            $.ajax({
                type: "GET",
                url: "{{ route('filter.bycity') }}", // Adjust if needed
                data: {
                    'city_id': cityId,
                    'region_id': regionId
                },
                success: function(data) {
                    $('#listing-container').html(''); // Clear existing listings
                    if (data.listings.length > 0) {
                        data.listings.forEach(function(listing) {
                            var images = listing.images.length > 0 ?
                                `<img src="/storage/${listing.images[0].image_url}" class="card-img-top custom-img" alt="Main Image">` :
                                '<span>No image</span>';

                            var listingCard = `
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            ${images}
                            <h5 class="card-title">${listing.headline}</h5>
                            <p class="card-text">${listing.description}</p>
                            <div class="d-flex justify-content-between mt-2 py-1 ml-2">
                                <a href="/listing/view/${listing.id}" class="btn btn-primary">View</a>
                                <a href="/order/buy/${listing.id}" class="btn btn-primary">Buy</a>
                            </div>
                        </div>
                    </div>`;
                            $('#listing-container').append(listingCard);
                        });
                    } else {
                        $('#listing-container').html('<h3>No Listings Found</h3>');
                    }
                },
                error: function(err) {
                    console.log(err.responseText);
                }
            });
        });



        $("#listing_key").on("keyup", function() {
            var searchQuery = $(this).val().trim();

            if (searchQuery === '') {
                $("#listing-container").html(''); // Clear listings if search is empty
                return;
            }

            $.ajax({
                type: "GET",
                url: "{{ route('listing.search') }}", // Ensure this route matches your new controller method
                data: {
                    'search': searchQuery
                },
                success: function(data) {
                    $('#listing-container').html(''); // Clear previous results
                    if (data.listings.length > 0) {
                        data.listings.forEach(function(listing) {
                            var images = listing.images.length > 0 ?
                                `<img src="/storage/${listing.images[0].image_url}" class="card-img-top custom-img" alt="Main Image">` :
                                '<span>No image</span>';
                            var listingCard = `
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            ${images}
                            <h5 class="card-title">${listing.headline}</h5>
                            <p class="card-text">${listing.description}</p>
                            <div class="d-flex justify-content-between mt-2 py-1 ml-2">
                                <a href="/listing/view/${listing.id}" class="btn btn-primary">View</a>
                                <a href="/order/buy/${listing.id}" class="btn btn-primary">Buy</a>
                            </div>
                        </div>
                    </div>`;
                            $('#listing-container').append(listingCard);
                        });
                    } else {
                        $('#listing-container').html('<h3>No Listings Found</h3>');
                    }
                },
                error: function(err) {
                    console.log(err.responseText);
                }
            });
        });
    </script>
@endsection
