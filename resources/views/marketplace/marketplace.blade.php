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
                            <img src="{{ asset($listing->images->first()->image_url) }}" class="card-img-top custom-img"
                                alt="Main Image">
                        @else
                            <span>No image</span>
                        @endif
                        <h5 class="card-title">Name: {{ $listing->headline }}</h5>
                        <p class="card-text">
                        <p>
                        <h5 style="display: inline">Price: </h5>${{ $listing->price }}</p>
                        <div class="d-flex justify-content-between mt-2 py-1 ml-2">
                            <a href="{{ route('listing.view', $listing->id) }}" class="btn btn-primary">View</a>
                            <a href="javascript:void(0)" class="btn btn-primary buy-btn"
                                data-listing-id="{{ $listing->id }}" data-listing-name="{{ $listing->headline }}"
                                data-listing-price="{{ $listing->price }}">Buy</a>
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

            Swal.fire({
                title: 'Please Wait!',
                html: 'Fetching regions...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            regionSelect.innerHTML = '<option value="">Select region</option>'; // Clear previous options

            if (cityId) {
                fetch(`/api/regions?city_id=${cityId}`)
                    .then(response => response.json())
                    .then(data => {
                        setTimeout(() => { // 1-second delay
                            data.forEach(region => {
                                let option = document.createElement('option');
                                option.value = region.id;
                                option.textContent = region.region_name;
                                regionSelect.appendChild(option);
                            });
                            Swal.close();
                        }, 1000);
                    })
                    .catch(error => {
                        Swal.close();
                        console.error('Error fetching regions:', error);
                    });
            } else {
                Swal.close();
            }
        });

        $("#city-select, #region-select").on('change', function() {
            var cityId = $("#city-select").val();
            var regionId = $("#region-select").val();

            Swal.fire({
                title: 'Please Wait!',
                html: 'Loading listings...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                type: "GET",
                url: "{{ route('filter.bycity') }}",
                data: {
                    'city_id': cityId,
                    'region_id': regionId
                },
                success: function(data) {
                    setTimeout(() => { // 1-second delay
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
                                            <h5 class="card-title"> Name: ${listing.headline}</h5>
                                            <p class="card-text"><h5 style="display: inline">Price: </h5>${listing.price}</p>
                                            <div class="d-flex justify-content-between mt-2 py-1 ml-2">
                                                <a href="/listing/view/${listing.id}" class="btn btn-primary">View</a>
                                              <a href="javascript:void(0)" class="btn btn-primary buy-btn"
                                                data-listing-id="${listing.id}"
                                                data-listing-name="${listing.headline}"
                                                data-listing-price="${listing.price}">
                                                Buy
                                                </a>
                                            </div>
                                        </div>
                                    </div>`;
                                $('#listing-container').append(listingCard);
                            });
                        } else {
                            $('#listing-container').html('<h3>No Listings Found</h3>');
                        }
                        Swal.close();
                    }, 1000);
                },
                error: function(err) {
                    setTimeout(() => { // 1-second delay
                        Swal.close();
                        console.log(err.responseText);
                    }, 1000);
                }
            });
        });

        $("#listing_key").on("keyup", function() {
            var searchQuery = $(this).val().trim();

            if (searchQuery === '') {
                $("#listing-container").html(''); // Clear listings if search is empty
                return;
            }

            // Swal.fire({
            //     title: 'Please Wait!',
            //     html: 'Searching listings...',
            //     allowOutsideClick: false,
            //     didOpen: () => {
            //         Swal.showLoading();
            //     }
            // });

            $.ajax({
                type: "GET",
                url: "{{ route('listing.search') }}",
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
                                <h5 class="card-title"> Name: ${listing.headline}</h5>
                                <p class="card-text"><h5 style="display: inline">Price: </h5>${listing.price}</p>
                                <div class="d-flex justify-content-between mt-2 py-1 ml-2">
                                    <a href="/listing/view/${listing.id}" class="btn btn-primary">View</a>
                                    <a href="javascript:void(0)" class="btn btn-primary buy-btn"
                                       data-listing-id="${listing.id}"
                                       data-listing-name="${listing.headline}"
                                       data-listing-price="${listing.price}">
                                       Buy
                                    </a>
                                </div>
                            </div>
                        </div>`;
                            $('#listing-container').append(listingCard);
                        });
                    } else {
                        $('#listing-container').html('<h3>No Listings Found</h3>');
                    }
                    Swal.close();
                },
                error: function(err) {
                    Swal.close();
                    console.log(err.responseText);
                }
            });
        });




        $(document).on('click', '.buy-btn', function() {
            let listingId = $(this).data('listing-id'); // Get the listing ID
            let listingName = $(this).data('listing-name'); // Get the listing name
            let listingPrice = $(this).data('listing-price');

            Swal.fire({
                title: `Do you like to buy | ${listingName} | for  $${listingPrice}?`,
                text: "",
                icon: "success",
                showCancelButton: true, // Show cancel button
                confirmButtonText: "Yes, proceed to PayPal",
                cancelButtonText: "No, cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the "orders.buy" route with the listing ID
                    window.location.href = "{{ route('orders.buy', ':id') }}".replace(':id', listingId);
                } else {
                    // User clicked "No"
                    Swal.fire('Cancelled', 'You did not proceed with the purchase.', 'info');
                }
            });
        });
    </script>
@endsection
