@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Shipping Orders</h5>
            {{-- <a href="{{ route('listings.create') }}" class="btn btn-primary ml-4 col-md-3 mb-4">Create Listing</a> --}}
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Buyer Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 data-table">
                        @foreach ($orders as $order)
                            <tr>
                                <td>
                                    @if ($order->Orderlisting)
                                        <p>{{ $order->Orderlisting->headline }}</p>
                                    @else
                                        <p>No listing available for this order.</p>
                                    @endif
                                </td>
                                <td>{{ $order->Orderlisting->price }}</td>
                                <td>{{ $order->buyer->name }}</td>
                                <td>{{ $order->status }}</td>

                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">


                                            <form action="{{ route('orders.delivered', $order->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item">
                                                    <i class="bx bx-loader bx-spin me-1"></i> Delivered
                                                </button>
                                            </form>






                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr class="my-12" />
        {{-- {{ $listings->links() }} --}}
    </div>

    {{-- Success and Error Alerts --}}
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
