@extends('layouts.app')

@section('content')
    @push('styles')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            .pagination {
                display: flex;
                justify-content: end;
            }
        </style>
    @endpush

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Pay To Seller</h5>


            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Seller Name</th>
                            <th>Buyer Status</th>
                            <th>Action</th>


                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 data-table">
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->Orderlisting->headline }} </td>
                                <td>{{ $order->seller->name }}</td>
                                <td>{{ $order->buyer_status }}</td>
                                <td><button type="button" class="btn btn-primary view-order"
                                        data-order-id="{{ $order->id }}" data-bs-toggle="modal"
                                        data-bs-target="#orderModal">
                                        Pay
                                    </button></td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr class="my-2" />
        {{ $orders->links() }}
    </div>
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Seller Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Input for number -->
                    <div class="mb-3">
                        <label for="paymentAmount" class="form-label">Payment Amount</label>
                        <input type="number" class="form-control" id="paymentAmount" placeholder="Enter amount">
                    </div>
                    <!-- Input for image -->
                    <div class="mb-3">
                        <label for="paymentImage" class="form-label">Upload Payment Proof</label>
                        <input type="file" class="form-control" id="paymentImage" accept="image/*">
                    </div>
                    <input type="hidden" id="orderId" value="">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary pay-button">Pay</button>

                </div>
            </div>
        </div>
    </div>
@endsection



@section('customjs')
    <script>
        $(document).ready(function() {



            $(document).on('click', '.view-order', function() {
                let orderId = $(this).data('order-id');

                $.ajax({
                    type: "GET",
                    url: "{{ route('order.details') }}",
                    data: {
                        order_id: orderId
                    },
                    success: function(data) {
                        if (data.success) {

                            $('#paymentAmount').val(data.without_commission_price);

                            $('#orderId').val(orderId);
                            $('#orderModal').modal('show');
                        } else {
                            console.log('Order not found');
                        }
                    },
                    error: function(e) {
                        console.log(e.responseText);
                    }
                });
            });



            $("#orderModal").on("click", ".pay-button", function(e) {
                e.preventDefault();

                var orderId = $("#orderId").val();

                var data = new FormData();
                data.append('payment_amount', $("#paymentAmount").val());
                data.append('payment_image', $("#paymentImage")[0].files[0]);
                data.append('order_id', orderId);


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                $.ajax({
                    type: "POST",
                    url: "{{ route('pay.seller') }}",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(response) {

                        $("#orderModal").modal('hide');
                        alert(response.message);
                        window.location.reload();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

        });
    </script>
@endsection
