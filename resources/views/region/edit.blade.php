@extends('layouts.app')

@section('content')
    <form action="{{ route('regions.update', $region->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Layout -->
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-6">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Edit Region</h5>
                            <small class="text-muted float-end">Edit region details</small>
                        </div>
                        <div class="card-body">
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label">City</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="city_id" id="city-select">
                                        <option value="">Select city</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                {{ $region->city_id == $city->id ? 'selected' : '' }}>
                                                {{ $city->city_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('city_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="region_name" id="basic-default-name"
                                        placeholder="Enter region name"
                                        value="{{ old('region_name', $region->region_name) }}" />
                                    @error('region_name')
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
            </div>
        </div>
    </form>
@endsection