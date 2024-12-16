@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-header">Leads</h5>
                </div>
                <div class="col-md-5 mt-5 mr-4">


                </div>
                <div class="row ml-3">
                    <div class="col-md-2 ">
                        <a href="{{ route('leads.index') }}" class="btn btn-primary  mb-4">All</a>
                    </div>
                    <div class="col-md-2"><button id="btn-active" class="btn btn-primary button mb-4">Active</button></div>
                    <div class="col-md-2"><button id="btn-closed" class="btn btn-primary button mb-4">Closed</button></div>
                    <div class="col-md-2"><button id="btn-pending" class="btn btn-primary button mb-4">Pending</button></div>
                    <div class="col-md-2"><button id="btn-not-closed" class="btn btn-primary button mb-4">Not Closed</button></div>

                    <div class="col-md-2"><a href="{{ route('leads.create') }}"
                            class="btn btn-primary ml-4  mb-4 float-end">Create
                            Lead</a></div>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table" id="mytable">
                    <thead>
                        <tr>
                            <th>Lead Number</th>
                            <th>Vehicle</th>
                            <th>Name</th>

                            <th>Phone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($leads as $lead)
                            <tr>
                                <td>{{ $lead->lead_number }}</td>
                                <td>{{ $lead->lead_vehicle }}</td>
                                <td>{{ $lead->customer->name }}</td>
                                <td>{{ $lead->customer->phone }}</td>
                                <td>{{ $lead->customer->email }}</td>
                                <td>
                                    @php
                                        switch ($lead->status) {
                                            case 0:
                                                $statusText = 'Pending';
                                                break;
                                            case 1:
                                                $statusText = 'Accepted';
                                                break;
                                            case 2:
                                                $statusText = 'Closed';
                                                break;
                                            default:
                                                $statusText = 'Unknown Status';
                                                break;
                                        }
                                    @endphp
                                    {{ $statusText }}
                                </td>

                                <td>
                                    <!-- Edit Button -->
                                    <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-primary btn-sm me-2">
                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                    </a>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target=".bd-example-modal-sm"
                                        class="btn btn-warning btn-sm me-2 view-lead" data-lead-id="{{ $lead->id }}">
                                        <i class="bx bx-edit-alt me-1"></i> View
                                    </a>


                                    <!-- Delete Button -->
                                    <form action="{{ route('leads.destroy', $lead->id) }}" method="POST"
                                        id="delete-lead-form-{{ $lead->id }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmLeadDelete({{ $lead->id }})">
                                            <i class="bx bx-trash me-1"></i> Delete
                                        </button>
                                    </form>


                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>
        </div>
        <hr class="my-12" />
        {{ $leads->links() }}
        <!--/ Basic Bootstrap Table -->





    </div>


    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Content will be dynamically inserted here by the JavaScript -->
            </div>
        </div>
    </div>


    @if (Session::has('success'))
        <script>
            swal("Good job!", "{{ Session::get('success') }}", "success");
        </script>
    @endif
@endsection


@section('customjs')
    <script>

            $(document).ready(function() {
                // Function to handle filter buttons
                $(".button").on('click', function() {
                    // Get the button text to determine the status
                    const statusText = $(this).text().trim();
                    let status;

                    // Map button text to status codes
                    switch (statusText) {
                        case 'Active':
                            status = 1; // Replace with your corresponding status code
                            break;
                        case 'Closed':
                            status = 2; // Replace with your corresponding status code
                            break;
                        case 'Pending':
                            status = 0; // Replace with your corresponding status code
                            break;
                        case 'Not Closed':
                            status = 3; // Replace with your corresponding status code
                            break;
                        default:
                            status = null;
                    }

                    // Show loading indicator
                    Swal.fire({
                        title: 'Loading...',
                        text: 'Fetching leads data...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // AJAX request to fetch data based on the status
                    $.ajax({
                        type: "GET",
                        url: "{{ route('leads.filter') }}", // Replace with your route
                        data: {
                            status: status
                        }, // Send status as a parameter
                        success: function(data) {
                            // Clear existing table rows
                            $("#mytable tbody").html('');

                            // Check if data is available
                            if (data.length > 0) {
                                // Populate table rows
                                data.forEach((lead) => {
                                    $("#mytable tbody").append(`
                                        <tr>
                                            <td>${lead.lead_number}</td>
                                            <td>${lead.lead_vehicle}</td>
                                            <td>${lead.customer ? lead.customer.name : 'N/A'}</td>
                                            <td>${lead.customer ? lead.customer.phone : 'N/A'}</td>
                                            <td>${lead.customer ? lead.customer.email : 'N/A'}</td>
                                            <td>${getLeadStatus(lead.lead_status)}</td>
                                            <td>
                                                <a href="javascript:void(0);" class="btn btn-warning btn-sm view-lead" data-lead-id="${lead.id}">
                                                    <i class="bx bx-edit-alt me-1"></i> View
                                                </a>
                                                <a href="{{ route('leads.edit', '') }}/${lead.id}" class="btn btn-primary btn-sm">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                            </td>
                                         </tr>
                                     `);
                                });
                            } else {
                                // If no data, show a "No Records Found" message
                                $("#mytable tbody").append(
                                    "<tr><td colspan='7'>No Records Found</td></tr>");
                            }

                            // Close the Swal loading indicator
                            Swal.close();
                        },
                        error: function(error) {
                            console.error('Error:', error);

                            // Show error message
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Failed to fetch data. Please try again later.'
                            });
                        }
                    });
                });

                $("#mytable").on("click", ".view-lead", function() {
                    var leadId = $(this).data('lead-id');

                    $.ajax({
                        url: '{{ route('leads.show') }}',
                        method: 'GET',
                        data: {
                            lead_id: leadId
                        },
                        success: function(response) {
                            // Log the response to check if it's correctly structured
                            console.log(response);

                            if (response.lead_details) {
                                var lead = response.lead_details;
                                var customer = lead.customer;
                                var formattedDob = new Date(customer.dob)
                            .toLocaleDateString(); // Format DOB

                                // Create the modal content dynamically
                                var modalContent = `
                    <div class="card">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="card-header text-center">Leads Information</h5>
                            </div>
                            <div class="col-md-12">
                                <div class="container">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Number</th>
                                                <th>Vehicle</th>
                                                <th>Source</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>${getLeadStatus(lead.lead_status)}</td>
                                                <td>${lead.lead_date}</td>
                                                <td>${lead.lead_number}</td>
                                                <td>${lead.lead_vehicle}</td>
                                                <td>${lead.lead_source}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="card-header text-center">Customer Information</h5>
                            </div>
                            <div class="col-md-12">
                                <div class="container">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Occupation</th>
                                                <th>Date of Birth</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>${customer.name}</td>
                                                <td>${customer.email}</td>
                                                <td>${customer.phone}</td>
                                                <td>${customer.address}</td>
                                                <td>${customer.occupation}</td>
                                                <td>${formattedDob}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                                // Insert the modal content dynamically
                                $(".modal-content").html(modalContent);

                                // Open the modal
                                $(".bd-example-modal-xl").modal('show');
                            }
                        },
                        error: function(error) {
                            console.log('Error:', error);
                        }
                    });
                });

                function getLeadStatus(status) {
                    switch (Number(status)) {
                        case 0:
                            return "Pending";
                        case 1:
                            return "Active";
                        case 2:
                            return "Closed";
                        default:
                            return "Not Closed";
                    }
                }

            });



















    </script>

    <script>
        function confirmLeadDelete(leadId) {
            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-lead-form-${leadId}`).submit();
                }
            });
        }
    </script>
@endsection
