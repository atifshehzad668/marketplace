@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="row">
                <div class="col-md-2">
                    <h5 class="card-header">Saleman Leads</h5>
                </div>
                <div class="col-md-2 mt-4">
                    <button id="accepted-btn" class="btn btn-primary">Accepted Lead</button>
                </div>
                <div class="col-md-2 mt-4">
                    <button id="closed-btn" class="btn btn-primary">Closed Lead</button>
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
                                    <!-- Edit Button -->

                                    <a href="javascript:void(0);" data-toggle="modal" data-target=".bd-example-modal-sm"
                                        class="btn btn-warning btn-sm me-2 view-lead" data-lead-id="{{ $lead->id }}">
                                        <i class="bx bx-edit-alt me-1"></i> View
                                    </a>
                                    <a href="{{ route('salesman.lead.accept.create', $lead->id) }}"
                                        class="btn btn-primary btn-sm me-2 view-lead">
                                        <i class="bx bx-dollar me-1"></i> Make Sale
                                    </a>
                                    <a href="{{ route('saleman.conversation', $lead->id) }}"
                                        class="btn btn-dark btn-sm me-2 view-lead">
                                        <i class="bx bx-message me-1"></i> Conversation
                                    </a>


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


    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
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
        $("#mytable").on("click", ".view-lead", function() {
            // Get the lead id from the clicked element's data attribute
            var leadId = $(this).data('lead-id');

            // Sending the leadId in an AJAX request
            $.ajax({
                url: '{{ route('leads.show') }}', // Replace with your AJAX endpoint
                method: 'GET',
                data: {
                    lead_id: leadId
                },
                success: function(response) {
                    // Check if the response contains lead details
                    if (response.lead_details) {
                        var lead = response.lead_details;

                        // Log the lead_status to check the value
                        console.log('Lead Status:', lead.lead_status);

                        // Populate modal with lead details
                        $(".modal-content").html(`
                    <div class="modal-body">
                        <p style="padding: 10px 0;"><strong>Lead Status:</strong> ${getLeadStatus(lead.lead_status)}</p>
                        <p style="padding: 10px 0;"><strong>Lead Date:</strong> ${lead.lead_date}</p>
                        <p style="padding: 10px 0;"><strong>Lead Number:</strong> ${lead.lead_number}</p>
                        <p style="padding: 10px 0;"><strong>Lead Vehicle:</strong> ${lead.lead_vehicle}</p>
                        <p style="padding: 10px 0;"><strong>Lead Source:</strong> ${lead.lead_source}</p>
                        <p style="padding: 10px 0;"><strong>Customer Name:</strong> ${lead.customer.name}</p>
                        <p style="padding: 10px 0;"><strong>Customer Email:</strong> ${lead.customer.email}</p>
                        <p style="padding: 10px 0;"><strong>Customer Phone:</strong> ${lead.customer.phone}</p>
                        <p style="padding: 10px 0;"><strong>Customer Address:</strong> ${lead.customer.address}</p>
                        <p style="padding: 10px 0;"><strong>Customer Occupation:</strong> ${lead.customer.occupation}</p>
                        <p style="padding: 10px 0;"><strong>Customer Date of Birth:</strong> ${lead.customer.dob}</p>
                    </div>
                `);

                        // Open the modal
                        $(".bd-example-modal-sm").modal('show');
                    }
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        });

        function getLeadStatus(status) {

            status = Number(status);

            console.log('Received Status:', status);


            if (status === 0) {
                return "Pending";
            } else if (status === 1) {
                return "Accepted";
            } else if (status === 2) {
                return "Closed";
            } else {
                return "Unknown Status";
            }
        }








        $("#accepted-btn").on('click', function() {
            // Show Swal loading indicator
            Swal.fire({
                title: 'Loading...',
                text: 'Please wait while we fetch the data.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                type: "GET",
                url: "{{ route('salesman.accepted.leads') }}",
                success: function(data) {
                    // Delay for 2 seconds before closing the loading indicator
                    setTimeout(() => {
                        // Clear the existing table body
                        $("#mytable tbody").html('');

                        if (data.length > 0) {
                            // Loop through the data and append rows to the table
                            $.each(data, function(key, value) {
                                $("#mytable tbody").append(`
                            <tr>
                                <td>${value.lead_number}</td>
                                <td>${value.lead_vehicle}</td>
                                <td>${value.customer ? value.customer.name : 'N/A'}</td>
                                <td>${value.customer ? value.customer.phone : 'N/A'}</td>
                                <td>${value.customer ? value.customer.email : 'N/A'}</td>
                                <td>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target=".bd-example-modal-sm"
                                       class="btn btn-warning btn-sm me-2 view-lead" data-lead-id="${value.id}">
                                        <i class="bx bx-edit-alt me-1"></i> View
                                    </a>
                                    <a href="{{ route('salesman.lead.accept.create', '') }}/${value.id}" class="btn btn-primary btn-sm me-2">
                                        <i class="bx bx-dollar me-1"></i> Make Sale
                                    </a>
                                </td>
                            </tr>
                        `);
                            });
                        } else {
                            // If no data, display a "No Records Found" message
                            $("#mytable tbody").append(
                                "<tr><td colspan='6'>No Records Found</td></tr>"
                            );
                        }

                        // Close the Swal loading indicator
                        Swal.close();
                    }, 1000); // 2-second delay
                },
                error: function(err) {
                    console.error(err.responseText);

                    // Show an error message if the request fails
                    setTimeout(() => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to fetch data. Please try again later.'
                        });
                    }, 2000); // 2-second delay
                }
            });
        });








        $("#closed-btn").on('click', function() {
            // Show Swal loading indicator
            Swal.fire({
                title: 'Loading...',
                text: 'Please wait while we fetch the data.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                type: "GET",
                url: "{{ route('salesman.closed.leads') }}", // Adjusted route for closed leads
                success: function(data) {
                    // Delay for 2 seconds before closing the loading indicator
                    setTimeout(() => {
                        // Clear the existing table body
                        $("#mytable tbody").html('');

                        if (data.length > 0) {
                            // Loop through the data and append rows to the table
                            $.each(data, function(key, value) {
                                $("#mytable tbody").append(`
                            <tr>
                                <td>${value.lead_number}</td>
                                <td>${value.lead_vehicle}</td>
                                <td>${value.customer ? value.customer.name : 'N/A'}</td>
                                <td>${value.customer ? value.customer.phone : 'N/A'}</td>
                                <td>${value.customer ? value.customer.email : 'N/A'}</td>
                                <td>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target=".bd-example-modal-sm"
                                       class="btn btn-warning btn-sm me-2 view-lead" data-lead-id="${value.id}">
                                        <i class="bx bx-edit-alt me-1"></i> View
                                    </a>
                                    <a href="{{ route('salesman.lead.accept.create', '') }}/${value.id}" class="btn btn-primary btn-sm me-2">
                                        <i class="bx bx-dollar me-1"></i> Make Sale
                                    </a>
                                </td>
                            </tr>
                        `);
                            });
                        } else {
                            // If no data, display a "No Records Found" message
                            $("#mytable tbody").append(
                                "<tr><td colspan='6'>No Records Found</td></tr>"
                            );
                        }

                        // Close the Swal loading indicator
                        Swal.close();
                    }, 1000); // 2-second delay
                },
                error: function(err) {
                    console.error(err.responseText);

                    // Show an error message if the request fails
                    setTimeout(() => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to fetch data. Please try again later.'
                        });
                    }, 2000); // 2-second delay
                }
            });
        });
    </script>
@endsection
