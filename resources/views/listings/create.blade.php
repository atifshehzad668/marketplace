@extends('layouts.app')

@section('content')
    <form action="{{ route('listings.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-6">
                <div class="card-header">
                    <h5 class="mb-0">Create Listing</h5>
                </div>
                <div class="card-body">
                    <!-- Headline -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label">Headline</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="headline" placeholder="Headline" />
                            @error('headline')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Category Dropdown -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="category_id">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- City Dropdown -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label">City</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="city_id" id="city-select">
                                <option value="">Select city</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->city_name }}</option>
                                @endforeach
                            </select>
                            @error('city_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Region Dropdown -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label">Region</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="region_id" id="region-select">
                                <option value="">Select region</option>
                            </select>
                            @error('region_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label">Images</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="images[]" multiple max="10" />
                            <small class="text-muted">You can upload up to 10 images.</small> <!-- Info message -->
                            @error('images')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <!-- Description -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="description" placeholder="Description"></textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>




                    {{-- require_shipping --}}
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label">Shipping Require</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="require_shipping" id="require_shipping_select">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>

                            </select>
                            @error('require_shipping')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Quantity -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="quantity" value="1" min="1" />
                            @error('quantity')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="price" />
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Expiration Date -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label">Expiration Date</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="expiration_date" />
                            @error('expiration_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
    </script>
@endsection
