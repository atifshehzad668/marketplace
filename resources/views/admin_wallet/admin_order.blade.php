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
                <h5 class="mb-0">All Orders</h5>


            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>


                            <th>Seller Name</th>
                            <th>Buyer Name</th>
                            <th>Seller Contact</th>
                            <th>Buyer Contact</th>
                            <th>Order Status</th>
                            <th>Seller Status</th>
                            <th>Buyer Status</th>


                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 data-table">
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->Orderlisting->headline }} | ${{ $order->Orderlisting->price }}</td>


                                <td>{{ $order->seller->name }}</td>
                                <td>{{ $order->buyer->name }}</td>
                                <td>{{ $order->seller->contact }}</td>
                                <td>{{ $order->buyer->contact }}</td>



                                <td>{{ $order->status }}</td>
                                <td>{{ $order->seller_status }}</td>
                                <td>{{ $order->buyer_status }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr class="my-2" />
        {{ $orders->links() }}
    </div>
@endsection
