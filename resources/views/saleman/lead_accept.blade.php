@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Accept Lead</h5>
                    <small class="text-muted float-end">Accept Lead</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('salesman.lead.make_sale.store') }}" method="POST">
                        @csrf

                        <!-- Vehicle Name -->
                        <div class="mb-6">
                            <label class="form-label" for="vehicle">Vehicle Name</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-car"></i></span>
                                <input type="text" id="vehicle" name="vehicle" class="form-control"
                                    placeholder="Vehicle name" value="{{ old('vehicle') }}" />
                            </div>
                            @error('vehicle')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Vehicle Brand -->
                        <div class="mb-6">
                            <label class="form-label" for="vehicle_brand">Vehicle Brand</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-car"></i></span>
                                <input type="text" id="vehicle_brand" name="vehicle_brand" class="form-control"
                                    placeholder="Vehicle Brand" value="{{ old('vehicle_brand') }}" />
                            </div>
                            @error('vehicle_brand')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Model -->
                        <div class="mb-6">
                            <label class="form-label" for="model">Model</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-car"></i></span>
                                <input type="text" id="model" name="model" class="form-control" placeholder="Model"
                                    value="{{ old('model') }}" />
                            </div>
                            @error('model')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Year -->
                        <div class="mb-6">
                            <label class="form-label" for="year">Year</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                <input type="number" id="year" name="year" class="form-control" placeholder="Year"
                                    value="{{ old('year') }}" />
                            </div>
                            @error('year')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Mileage -->
                        <div class="mb-6">
                            <label class="form-label" for="mileage">Mileage</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-tachometer"></i></span>
                                <input type="text" id="mileage" name="mileage" class="form-control"
                                    placeholder="Mileage" value="{{ old('mileage') }}" />
                            </div>
                            @error('mileage')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date of Sale -->
                        <div class="mb-6">
                            <label class="form-label" for="date_of_sale">Date of Sale</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                <input type="date" class="form-control" id="date_of_sale" name="date_of_sale"
                                    value="{{ old('date_of_sale') }}" />
                            </div>
                            @error('date_of_sale')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sales Representative -->
                        <div class="mb-6">
                            <label class="form-label" for="sale_rep">Sales Representative</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-user"></i></span>
                                <input type="text" id="sale_rep" name="sale_rep" class="form-control"
                                    placeholder="Sales Representative" value="{{ old('sale_rep') }}" />
                            </div>
                            @error('sale_rep')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="lead_id" value="{{ $lead_id }}">
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Save Lead</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (Session::has('success'))
        <script>
            swal("Good job!", "{{ Session::get('success') }}", "success");
        </script>
    @endif
@endsection
