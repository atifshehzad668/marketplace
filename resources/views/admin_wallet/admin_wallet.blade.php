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
    <div class="modal fade" id="transactionModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Transaction Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="transaction-details">Loading...</p>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Admin Wallet Transaction</h5>
                <div class="admin-balance-info d-flex align-items-center justify-content-center p-2"
                    style="width: 200px; height: 50px; background-color: #f0f0f0; border-radius: 8px;">
                    <strong>Balance:</strong> ${{ number_format($wallet_balance->balance, 2) }}
                </div>

            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Seller Name</th>
                            <th>Order Name</th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>Transaction Key</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 data-table">
                        @foreach ($wallet_transactions as $wallet_transaction)
                            <tr>
                                {{-- <td>{{ $wallet_transaction->admin_wallet_transaction->name }}</td> --}}
                                <td>{{ $wallet_transaction->order->seller->name }}</td>
                                <td>{{ $wallet_transaction->order->Orderlisting->headline }}</td>
                                <td>{{ $wallet_transaction->amount }}</td>
                                <td>{{ $wallet_transaction->type }}</td>
                                {{-- <td>{{ $wallet_transaction->transaction_ref }}</td> --}}
                                <td>
                                    <button type="button" class="btn btn-info view-transaction"
                                        data-transaction="{{ $wallet_transaction->transaction_ref }}"
                                        id="transaction_{{ $wallet_transaction->id }}">
                                        {{ $wallet_transaction->transaction_ref }}
                                    </button>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr class="my-2" />
        {{ $wallet_transactions->links() }}
    </div>
@endsection

@section('customjs')
    <script>
        $(document).ready(function() {
            // When the view-transaction button is clicked
            $('.view-transaction').on('click', function() {
                let transactionRef = $(this).data(
                'transaction'); // Get the transaction_ref from the button's data attribute

                // Show the modal
                $('#transactionModal').modal('show');

                // Set loading state initially
                $('#transaction-details').text('Loading...');

                // Make AJAX call to fetch transaction details
                $.ajax({
                    type: "GET",
                    url: "{{ route('transaction.description') }}", // Use the correct route for the description
                    data: {
                        transaction_ref: transactionRef
                    },
                    success: function(data) {
                        // Check if there's any description in the response (if applicable)
                        if (data.transaction_for_listing || data.payer || data.receiver || data
                            .amount || data.net_amount_after_fees) {
                            // Construct a string with the relevant data
                            var detailsHtml = `
                        <h5>Transaction for Listing: ${data.transaction_for_listing}</h5>
                        <h6>Payer:</h6>
                        <p>Name: ${data.payer.name}</p>
                        <p>Email: ${data.payer.email}</p>
                        <h6>Receiver:</h6>
                        <p>Name: ${data.receiver.name}</p>
                        <p>Role: ${data.receiver.role}</p>
                        <h6>Amount:</h6>
                        <p>${data.amount}</p>
                        <h6>Net Amount After Fees:</h6>
                        <p>${data.net_amount_after_fees}</p>
                    `;

                            // Set the formatted details content in the modal
                            $('#transaction-details').html(detailsHtml);
                        } else {
                            $('#transaction-details').html('No details available.');
                        }
                    },
                    error: function(e) {
                        console.log(e.responseText);
                        $('#transaction-details').text('Error loading transaction details.');
                    }
                });
            });
        });
    </script>
@endsection
