@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Purchase Orders</h5>
            {{-- <a href="{{ route('listings.create') }}" class="btn btn-primary ml-4 col-md-3 mb-4">Create Listing</a> --}}
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Seller Name</th>

                            <th>Status</th>

                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 data-table">


                        @foreach ($orders as $order)
                            <tr>
                                <td>
                                    @if ($order->Orderlisting)
                                        <p> {{ $order->Orderlisting->headline }}</p>
                                    @else
                                        <p>No listing available for this order.</p>
                                    @endif
                                </td>
                                <td> {{ $order->seller->name }}</td>

                                <td>{{ $order->status }}</td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr class="my-12" />
        {{-- {{ $listings->links() }} --}}
    </div>
    @if (Session::has('success'))
        <script>
            swal("Good job!", "{{ Session::get('success') }}", "success");
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            swal("sorry!", "{{ Session::get('error') }}", "error");
        </script>
    @endif
@endsection
