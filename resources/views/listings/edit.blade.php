@extends('layouts.app')

@section('content')
    <form action="{{ route('listings.update', $listing->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Use PUT for update -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-6">
                <div class="card-header">
                    <h5 class="mb-0">Edit Listing</h5>
                </div>
                <div class="card-body">
                    <!-- Headline -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label">Headline</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="headline" placeholder="Headline"
                                value="{{ old('headline', $listing->headline) }}" />
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
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $listing->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="description" placeholder="Description">{{ old('description', $listing->description) }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Quantity -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label">Quantity</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="quantity"
                                value="{{ old('quantity', $listing->quantity) }}" min="1" />
                            @error('quantity')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label">Images</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="images[]" multiple />
                            @error('images')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Expiration Date -->
                    <div class="row mb-6">
                        <label class="col-sm-2 col-form-label">Expiration Date</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="expiration_date"
                                value="{{ old('expiration_date', $listing->expiration_date) }}" />
                            @error('expiration_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
