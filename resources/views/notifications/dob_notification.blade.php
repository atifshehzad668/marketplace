@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="row">
                <div class="col-md-2">
                    <h5 class="card-header">Birth Days</h5>
                </div>
                {{-- <div class="col-md-2 mt-4">
                    <button id="accepted-btn" class="btn btn-primary">Accepted Lead</button>
                </div>
                <div class="col-md-2 mt-4">
                    <button id="closed-btn" class="btn btn-primary">Closed Lead</button>
                </div> --}}


            </div>
            <div class="table-responsive text-nowrap">
                <table class="table" id="mytable">
                    <thead>
                        <tr>
                            <th colspan="5">Notification</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($customers as $customer)
                            <tr>

                                <td colspan="5"><strong>{{ $customer->name }}</strong> have Birth Day on
                                    {{ \Carbon\Carbon::parse($customer->dob)->format('d-m-Y') }}
                                </td>

                                <td>
                                    <!-- Edit Button -->

                                    <a href="javascript:void(0);" data-toggle="modal" data-target=".bd-example-modal-sm"
                                        class="btn btn-warning btn-sm me-2 view-lead"
                                        data-customer-id="{{ $customer->id }}">
                                        <i class="bx bx-edit-alt me-1"></i> View
                                    </a>


                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>
        </div>
        <hr class="my-12" />
        {{ $customers->links() }}
        <!--/ Basic Bootstrap Table -->





    </div>


    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">



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
            var customerId = $(this).data('customer-id');

            // Sending the leadId in an AJAX request
            $.ajax({
                url: '{{ route('customer.show') }}', // Correctly formatted route directive
                method: 'GET',
                data: {
                    customerId: customerId
                },
                success: function(response) {
                    if (response.customer) {
                        var customer = response.customer;

                        // Format date of birth
                        var dob = new Date(customer.dob);
                        var formattedDob =
                            ("0" + dob.getDate()).slice(-2) + "-" +
                            ("0" + (dob.getMonth() + 1)).slice(-2) + "-" +
                            dob.getFullYear();

                        $(".modal-content").html(`
                                <div class="card">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="card-header justify-content-center text-center">Customer Information</h5>
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
                            `);



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








        // $("#accepted-btn").on('click', function() {
        //     // Show Swal loading indicator
        //     Swal.fire({
        //         title: 'Loading...',
        //         text: 'Please wait while we fetch the data.',
        //         allowOutsideClick: false,
        //         didOpen: () => {
        //             Swal.showLoading();
        //         }
        //     });

        //     $.ajax({
        //         type: "GET",
        //         url: "{{ route('salesman.accepted.leads') }}",
        //         success: function(data) {
        //             // Delay for 2 seconds before closing the loading indicator
        //             setTimeout(() => {
        //                 // Clear the existing table body
        //                 $("#mytable tbody").html('');

        //                 if (data.length > 0) {
        //                     // Loop through the data and append rows to the table
        //                     $.each(data, function(key, value) {
        //                         $("#mytable tbody").append(`
    //                     <tr>
    //                         <td>${value.lead_number}</td>
    //                         <td>${value.lead_vehicle}</td>
    //                         <td>${value.customer ? value.customer.name : 'N/A'}</td>
    //                         <td>${value.customer ? value.customer.phone : 'N/A'}</td>
    //                         <td>${value.customer ? value.customer.email : 'N/A'}</td>
    //                         <td>
    //                             <a href="javascript:void(0);" data-toggle="modal" data-target=".bd-example-modal-sm"
    //                                class="btn btn-warning btn-sm me-2 view-lead" data-lead-id="${value.id}">
    //                                 <i class="bx bx-edit-alt me-1"></i> View
    //                             </a>
    //                             <a href="{{ route('salesman.lead.accept.create', '') }}/${value.id}" class="btn btn-primary btn-sm me-2">
    //                                 <i class="bx bx-dollar me-1"></i> Make Sale
    //                             </a>
    //                         </td>
    //                     </tr>
    //                 `);
        //                     });
        //                 } else {
        //                     // If no data, display a "No Records Found" message
        //                     $("#mytable tbody").append(
        //                         "<tr><td colspan='6'>No Records Found</td></tr>"
        //                     );
        //                 }

        //                 // Close the Swal loading indicator
        //                 Swal.close();
        //             }, 1000); // 2-second delay
        //         },
        //         error: function(err) {
        //             console.error(err.responseText);

        //             // Show an error message if the request fails
        //             setTimeout(() => {
        //                 Swal.fire({
        //                     icon: 'error',
        //                     title: 'Error!',
        //                     text: 'Failed to fetch data. Please try again later.'
        //                 });
        //             }, 2000); // 2-second delay
        //         }
        //     });
        // });








        // $("#closed-btn").on('click', function() {
        //     // Show Swal loading indicator
        //     Swal.fire({
        //         title: 'Loading...',
        //         text: 'Please wait while we fetch the data.',
        //         allowOutsideClick: false,
        //         didOpen: () => {
        //             Swal.showLoading();
        //         }
        //     });

        //     $.ajax({
        //         type: "GET",
        //         url: "{{ route('salesman.closed.leads') }}", // Adjusted route for closed leads
        //         success: function(data) {
        //             // Delay for 2 seconds before closing the loading indicator
        //             setTimeout(() => {
        //                 // Clear the existing table body
        //                 $("#mytable tbody").html('');

        //                 if (data.length > 0) {
        //                     // Loop through the data and append rows to the table
        //                     $.each(data, function(key, value) {
        //                         $("#mytable tbody").append(`
    //                     <tr>
    //                         <td>${value.lead_number}</td>
    //                         <td>${value.lead_vehicle}</td>
    //                         <td>${value.customer ? value.customer.name : 'N/A'}</td>
    //                         <td>${value.customer ? value.customer.phone : 'N/A'}</td>
    //                         <td>${value.customer ? value.customer.email : 'N/A'}</td>
    //                         <td>
    //                             <a href="javascript:void(0);" data-toggle="modal" data-target=".bd-example-modal-sm"
    //                                class="btn btn-warning btn-sm me-2 view-lead" data-lead-id="${value.id}">
    //                                 <i class="bx bx-edit-alt me-1"></i> View
    //                             </a>
    //                             <a href="{{ route('salesman.lead.accept.create', '') }}/${value.id}" class="btn btn-primary btn-sm me-2">
    //                                 <i class="bx bx-dollar me-1"></i> Make Sale
    //                             </a>
    //                         </td>
    //                     </tr>
    //                 `);
        //                     });
        //                 } else {
        //                     // If no data, display a "No Records Found" message
        //                     $("#mytable tbody").append(
        //                         "<tr><td colspan='6'>No Records Found</td></tr>"
        //                     );
        //                 }

        //                 // Close the Swal loading indicator
        //                 Swal.close();
        //             }, 1000); // 2-second delay
        //         },
        //         error: function(err) {
        //             console.error(err.responseText);

        //             // Show an error message if the request fails
        //             setTimeout(() => {
        //                 Swal.fire({
        //                     icon: 'error',
        //                     title: 'Error!',
        //                     text: 'Failed to fetch data. Please try again later.'
        //                 });
        //             }, 2000); // 2-second delay
        //         }
        //     });
        // });
    </script>
@endsection
