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
                <h5 class="mb-0">Seller Wallet Transaction</h5>
                <div class="admin-balance-info d-flex align-items-center justify-content-center p-2"
                    style="width: 200px; height: 50px; background-color: #f0f0f0; border-radius: 8px;">
                    <strong>Balance:</strong> ${{ number_format($seller_wallet_balance->balance, 2) }}
                </div>

            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Buyer Name</th>
                            <th>Order Name</th>
                            <th>contact</th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>Transaction Key</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 data-table">
                        @foreach ($seller_wallet_transactions as $seller_wallet_transaction)
                            <tr>

                                <td>{{ $seller_wallet_transaction->order->buyer->name }}</td>
                                <td>{{ $seller_wallet_transaction->order->Orderlisting->headline }}</td>
                                <td>{{ $seller_wallet_transaction->order->buyer->contact }}</td>
                                <td>{{ $seller_wallet_transaction->amount }}</td>
                                <td>{{ $seller_wallet_transaction->type }}</td>

                                <td>{{ $seller_wallet_transaction->transaction_ref }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr class="my-2" />
        {{ $seller_wallet_transactions->links() }}
    </div>
@endsection
