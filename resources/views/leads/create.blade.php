@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Lead Information</h5>
                    <small class="text-muted float-end">Lead Information</small>
                </div>
                <div class="card-body">
                    {{-- <form action="{{ route('leads.store') }}" method="POST">
                        @csrf
                        <!-- Lead Date -->
                        <div class="mb-6">
                            <label class="form-label" for="basic-icon-default-fullname">Lead Date</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-calendar"></i></span>
                                <input type="date" class="form-control" id="basic-icon-default-fullname" name="lead_date"
                                    aria-describedby="basic-icon-default-fullname2" value="{{ old('lead_date') }}" />
                            </div>
                            @error('lead_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Lead Number -->
                        <div class="mb-6">
                            <label class="form-label" for="basic-icon-default-company">Lead Number</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text"><i
                                        class="bx bx-hash"></i></span>
                                <input type="number" id="basic-icon-default-company" name="lead_number"
                                    class="form-control" placeholder="Lead number" aria-label="Lead number"
                                    value="{{ old('lead_number') }}" aria-describedby="basic-icon-default-company2" />
                            </div>
                            @error('lead_number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Vehicle Interested In -->
                        <div class="mb-6">
                            <label class="form-label" for="basic-icon-default-company">Vehicle Interested In</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text"><i
                                        class="bx bx-car"></i></span>
                                <input type="text" id="basic-icon-default-company" name="lead_vehicle"
                                    class="form-control" placeholder="Vehicle name" aria-label="Vehicle name"
                                    value="{{ old('lead_vehicle') }}" aria-describedby="basic-icon-default-company2" />
                            </div>
                            @error('lead_vehicle')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Source -->
                        <div class="mb-6">
                            <label class="form-label" for="basic-icon-default-source">Source</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-link"></i></span>
                                <input type="text" name="lead_source" class="form-control" placeholder="Source"
                                    aria-label="Source" value="{{ old('lead_source') }}"
                                    aria-describedby="basic-icon-default-source" />
                            </div>
                            @error('lead_source')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <!-- Customer Information Header -->
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Customer Information</h5>
                        </div>

                        <!-- Select Customer -->
                        <div class="mb-6">
                            <label class="form-label" for="basic-icon-default-message">Select Customer</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-message2" class="input-group-text"><i
                                        class="bx bx-user-plus"></i></span>

                                <select id="customer_select" class="form-control">
                                    <option value="0">Add New Customer</option>

                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('customer_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Full Name -->
                        <div class="mb-6">
                            <label class="form-label" for="basic-icon-default-name">Full Name</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-name2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Full Name" aria-label="Full Name" value="{{ old('name') }}"
                                    aria-describedby="basic-icon-default-name2" />
                            </div>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-6">
                            <label class="form-label" for="basic-icon-default-email">Email</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-email" class="input-group-text"><i
                                        class="bx bx-envelope"></i></span>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Email" aria-label="Email" value="{{ old('email') }}"
                                    aria-describedby="basic-icon-default-email2" />
                            </div>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-6">
                            <label class="form-label" for="basic-icon-default-phone">Phone Number</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-phone2" class="input-group-text"><i
                                        class="bx bx-phone"></i></span>
                                <input type="tel" id="phone" name="phone" class="form-control"
                                    placeholder="Phone Number" aria-label="Phone Number" value="{{ old('phone') }}"
                                    aria-describedby="basic-icon-default-phone2" />
                            </div>
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="mb-6">
                            <label class="form-label" for="basic-icon-default-address">Address</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-address2" class="input-group-text"><i
                                        class="bx bx-home"></i></span>
                                <input type="text" id="address" name="address" class="form-control"
                                    placeholder="Address" aria-label="Address" value="{{ old('address') }}"
                                    aria-describedby="basic-icon-default-address2" />
                            </div>
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Occupation -->
                        <div class="mb-6">
                            <label class="form-label" for="basic-icon-default-occupation">Occupation</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-occupation2" class="input-group-text"><i
                                        class="bx bx-briefcase"></i></span>
                                <input type="text" id="occupation" name="occupation" class="form-control"
                                    placeholder="Occupation" aria-label="Occupation" value="{{ old('occupation') }}"
                                    aria-describedby="basic-icon-default-occupation2" />
                            </div>
                            @error('occupation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date of Birth -->
                        <div class="mb-6">
                            <label class="form-label" for="basic-icon-default-dob">Date of Birth</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-dob2" class="input-group-text"><i
                                        class="bx bx-calendar"></i></span>
                                <input type="date" id="dob" name="dob" class="form-control"
                                    aria-label="Date of Birth" value="{{ old('dob') }}"
                                    aria-describedby="basic-icon-default-dob2" />
                            </div>
                            @error('dob')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>



                        <!-- Stay on Same Page -->
                        <div class="form-check mb-6">
                            <input class="form-check-input" type="checkbox" name="stay_on_page" value="1"
                                {{ old('stay_on_page') ? 'checked' : '' }} id="stay_on_page">
                            <label class="form-check-label" for="stay_on_page">
                                Stay on same page
                            </label>
                            @error('stay_on_page')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Save Lead</button>
                    </form> --}}



                    <form action="{{ isset($lead) ? route('leads.update', $lead->id) : route('leads.store') }}"
                        method="POST">
                        @csrf

                        @if (isset($lead))
                            @method('POST')
                        @endif

                        <!-- Lead Date -->
                        <div class="mb-6">
                            <label class="form-label" for="basic-icon-default-fullname">Lead Date</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-calendar"></i></span>
                                <input type="date" class="form-control" id="basic-icon-default-fullname" name="lead_date"
                                    aria-describedby="basic-icon-default-fullname2"
                                    value="{{ old('lead_date', $lead->lead_date ?? '') }}" />
                            </div>
                            @error('lead_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Lead Number -->
                        <div class="mb-6">
                            <label class="form-label" for="basic-icon-default-company">Lead Number</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text"><i
                                        class="bx bx-hash"></i></span>
                                <input type="number" id="basic-icon-default-company" name="lead_number"
                                    class="form-control" placeholder="Lead number" aria-label="Lead number"
                                    value="{{ old('lead_number', $lead->lead_number ?? '') }}"
                                    aria-describedby="basic-icon-default-company2" />
                            </div>
                            @error('lead_number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Vehicle Interested In -->
                        <div class="mb-6">
                            <label class="form-label" for="basic-icon-default-company">Vehicle Interested In</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-company2" class="input-group-text"><i
                                        class="bx bx-car"></i></span>
                                <input type="text" id="basic-icon-default-company" name="lead_vehicle"
                                    class="form-control" placeholder="Vehicle name" aria-label="Vehicle name"
                                    value="{{ old('lead_vehicle', $lead->lead_vehicle ?? '') }}"
                                    aria-describedby="basic-icon-default-company2" />
                            </div>
                            @error('lead_vehicle')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Source -->
                        <div class="mb-6">
                            <label class="form-label" for="basic-icon-default-source">Source</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-link"></i></span>
                                <input type="text" name="lead_source" class="form-control" placeholder="Source"
                                    aria-label="Source" value="{{ old('lead_source', $lead->lead_source ?? '') }}"
                                    aria-describedby="basic-icon-default-source" />
                            </div>
                            @error('lead_source')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="basic-icon-default-message">Select Salesman</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-message2" class="input-group-text">
                                    <i class="bx bx-user-plus"></i>
                                </span>
                                <select id="salesman_select" class="form-control" name="saleman_id">
                                    <!-- 'Add New Salesman' option -->


                                    <!-- Salesman options -->
                                    @foreach ($salemans as $saleman)
                                        <option value="{{ $saleman->id }}"
                                            {{ old('saleman_id', $lead->saleman_id ?? '') == $saleman->id ? 'selected' : '' }}>
                                            {{ $saleman->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('saleman_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <hr>

                        <!-- Customer Information Header -->
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Customer Information</h5>
                        </div>

                        <!-- Select Customer -->
                        <div class="mb-6">
                            <label class="form-label" for="basic-icon-default-message">Select Customer</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-message2" class="input-group-text"><i
                                        class="bx bx-user-plus"></i></span>

                                <select id="customer_select" class="form-control" name="customer_id">
                                    <option value="0" style="display: {{ isset($lead) ? 'none' : 'block' }};">
                                        Add New Customer
                                    </option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}"
                                            {{ old('customer_id', $lead->customer_id ?? '') == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            @error('customer_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Full Name -->
                        <div class="mb-6">
                            <label class="form-label" for="basic-icon-default-name">Full Name</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-name2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Full Name" aria-label="Full Name"
                                    value="{{ old('name', $lead->customer->name ?? '') }}"
                                    aria-describedby="basic-icon-default-name2" />
                            </div>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-6">
                            <label class="form-label" for="basic-icon-default-email">Email</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-email" class="input-group-text"><i
                                        class="bx bx-envelope"></i></span>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Email" aria-label="Email"
                                    value="{{ old('email', $lead->customer->email ?? '') }}"
                                    aria-describedby="basic-icon-default-email2" />
                            </div>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-6">
                            <label class="form-label" for="basic-icon-default-phone">Phone Number</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-phone2" class="input-group-text"><i
                                        class="bx bx-phone"></i></span>
                                <input type="tel" id="phone" name="phone" class="form-control"
                                    placeholder="Phone Number" aria-label="Phone Number"
                                    value="{{ old('phone', $lead->customer->phone ?? '') }}"
                                    aria-describedby="basic-icon-default-phone2" />
                            </div>
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="mb-6">
                            <label class="form-label" for="basic-icon-default-address">Address</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-address2" class="input-group-text"><i
                                        class="bx bx-home"></i></span>
                                <input type="text" id="address" name="address" class="form-control"
                                    placeholder="Address" aria-label="Address"
                                    value="{{ old('address', $lead->customer->address ?? '') }}"
                                    aria-describedby="basic-icon-default-address2" />
                            </div>
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Occupation -->
                        <div class="mb-6">
                            <label class="form-label" for="basic-icon-default-occupation">Occupation</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-occupation2" class="input-group-text"><i
                                        class="bx bx-briefcase"></i></span>
                                <input type="text" id="occupation" name="occupation" class="form-control"
                                    placeholder="Occupation" aria-label="Occupation"
                                    value="{{ old('occupation', $lead->customer->occupation ?? '') }}"
                                    aria-describedby="basic-icon-default-occupation2" />
                            </div>
                            @error('occupation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Date of Birth -->
                        <div class="mb-6">
                            <label class="form-label" for="basic-icon-default-dob">Date of Birth</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-dob2" class="input-group-text"><i
                                        class="bx bx-calendar"></i></span>
                                <input type="date" id="dob" name="dob" class="form-control"
                                    aria-label="Date of Birth" value="{{ old('dob', $lead->customer->dob ?? '') }}"
                                    aria-describedby="basic-icon-default-dob2" />
                            </div>
                            @error('dob')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Stay on Same Page -->
                        {{-- <div class="form-check mb-6">
                            <input class="form-check-input" type="checkbox" name="stay_on_page" value="1"
                                {{ old('stay_on_page', $lead->stay_on_page ?? '') ? 'checked' : '' }} id="stay_on_page">
                            <label class="form-check-label" for="stay_on_page">
                                Stay on same page
                            </label>
                            @error('stay_on_page')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div> --}}
                        <div class="form-check mb-6" style="display: {{ isset($lead) ? 'none' : 'block' }};">
                            <input class="form-check-input" type="checkbox" name="stay_on_page" value="1"
                                {{ old('stay_on_page', $lead->stay_on_page ?? '') ? 'checked' : '' }} id="stay_on_page">
                            <label class="form-check-label" for="stay_on_page">
                                Stay on same page
                            </label>
                            @error('stay_on_page')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Submit Button -->
                        <button type="submit"
                            class="btn btn-primary">{{ isset($lead) ? 'Update Lead' : 'Save Lead' }}</button>
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

    @if (Session::has('error'))
        <script>
            swal("Sorry!", "{{ Session::get('error') }}", "error");
        </script>
    @endif
@endsection



@section('customjs')
    <script>
        $("#customer_select").on('change', function() {
            var customer_id = $(this).val();


            if (customer_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('get.customer.data') }}",
                    data: {
                        'customer_id': customer_id
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.customer) {

                            $('#name').val(data.customer.name);
                            $('#email').val(data.customer.email);
                            $('#phone').val(data.customer.phone);
                            $('#address').val(data.customer.address);
                            $('#occupation').val(data.customer.occupation);
                            $('#dob').val(data.customer.dob);
                        } else {

                            alert('Customer data not found');
                        }
                    },
                    error: function(err) {
                        console.log(err.responseText);
                    }
                });
            } else {

                $('#name').val('');
                $('#email').val('');
                $('#phone').val('');
                $('#address').val('');
                $('#occupation').val('');
                $('#dob').val('');
            }
        });
    </script>
@endsection
