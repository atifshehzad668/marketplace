@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Pending Orders</h5>
            {{-- <a href="{{ route('listings.create') }}" class="btn btn-primary ml-4 col-md-3 mb-4">Create Listing</a> --}}
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Seller Name</th>
                            <th>Buyer Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 data-table">
                        @foreach ($pending_orders as $order)
                            <tr>
                                <td>
                                    @if ($order->Orderlisting)
                                        <p>{{ $order->Orderlisting->headline }}</p>
                                    @else
                                        <p>No listing available for this order.</p>
                                    @endif
                                </td>

                                <td>{{ $order->seller->name }}</td>
                                <td>{{ $order->buyer->name }}</td>
                                <td>{{ $order->status }}</td>

                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            @if ($order->status !== 'Delivered')
                                                @if ($order->Orderlisting && $order->Orderlisting->user_id == Auth::id())
                                                    <form action="{{ route('orders.processing', $order->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="bx bx-loader bx-spin me-1"></i> Process
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif




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
