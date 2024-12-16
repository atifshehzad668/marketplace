@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-header">Pending Leads</h5>
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
                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm me-2"
                                        onclick="confirmLeadAccept({{ $lead->id }})">
                                        <i class="bx bx-check-circle me-1"></i> Accept
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








        function confirmLeadAccept(leadId) {
            Swal.fire({
                title: "Are you sure?",
                text: "Are you sure you want to accept this lead?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, accept it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform the accept action here
                    acceptLead(leadId);
                }
            });
        }

        function acceptLead(leadId) {
            // Use AJAX to send the request to your server
            $.ajax({
                url: "{{ route('leads.accept') }}", // Your route to handle accept action
                type: "POST",
                data: {
                    lead_id: leadId,
                    _token: "{{ csrf_token() }}" // Include CSRF token
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            "Accepted!",
                            "The lead has been successfully accepted.",
                            "success"
                        );

                        // Delay the reload by 1 second
                        setTimeout(() => {
                            location.reload();
                        }, 2000); // 1000ms = 1 second
                    } else {
                        Swal.fire(
                            "Error!",
                            response.message || "Something went wrong.",
                            "error"
                        );
                    }
                },
                error: function(xhr) {
                    Swal.fire(
                        "Error!",
                        xhr.responseJSON?.message || "An error occurred.",
                        "error"
                    );
                }
            });
        }
    </script>
@endsection
