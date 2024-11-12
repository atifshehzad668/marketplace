@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Roles</h5>
            {{-- <a href="{{ route('users.create') }}" class="btn btn-primary ml-4 col-md-3 mb-4">Create Roles</a> --}}
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Wallet Balance</th>
                            <th>Points Balance</th>
                            {{-- <th>Role</th> --}}
                            {{-- <th>Status</th> --}}
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            class="avatar avatar-xs pull-up" title="{{ $user->name }}">
                                            <img src="{{ asset($user->profile_image) }}" alt="Avatar"
                                                class="rounded-circle" />
                                        </li>
                                        {{-- <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                                        <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                                    </li>
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        class="avatar avatar-xs pull-up" title="Christina Parker">
                                        <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
                                    </li> --}}
                                    </ul>
                                </td>
                                <td> <span>{{ $user->email }}</span></td>
                                <td>
                                    <span><a href="">{{ $user->admin_wallet->balance ?? 'No Wallet' }}</a></span>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-primary view-points"
                                        data-order-id="{{ $user->id }}" data-bs-toggle="modal"
                                        data-bs-target="#orderModal">
                                        {{ $user->points_balance }}
                                    </button>
                                </td>

                                {{-- <td> <span>{{ $user->roles->pluck('name')->implode(', ') }}</span></td> --}}
                                {{-- <td>Albert Cook</td> --}}

                                {{-- <td><span class="badge bg-label-primary me-1">Active</span></td> --}}
                                {{-- <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('users.edit', $user->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>


                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </td> --}}
                            </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>
        </div>
        <hr class="my-12" />
        {{ $users->links() }}
        <!--/ Basic Bootstrap Table -->

        <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel">User's Points</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- Table Section -->
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Seller Name</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">type</th>
                                    </tr>
                                </thead>
                                <tbody id="orderDetailsBody" class="table-border-bottom-0">
                                    <!-- Data will be populated dynamically here -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
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
        $(document).ready(function() {

            $(document).on('click', '.view-points', function() {
                let userId = $(this).data('order-id'); // Get the user ID from the button's data attribute

                $.ajax({
                    type: "GET",
                    url: "{{ route('points.details') }}", // The route to fetch the order details (update if necessary)
                    data: {
                        user_id: userId // Pass the user ID to the backend
                    },
                    success: function(data) {
                        if (data.success) {
                            // Empty the table body before adding new rows
                            $('#orderDetailsBody').empty();

                            // Iterate over the data and populate the table with the user's order/payment details
                            data.seller_points_transactions.forEach(function(transaction,
                                index) {
                                let row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${transaction.user_seller.name}</td>
                            <td>${transaction.listings.headline}</td>
                            <td>${transaction.description}</td>
                            <td>${transaction.type}</td>
                        </tr>
                    `;
                                $('#orderDetailsBody').append(
                                    row);
                            });
                            let balanceRow = `
                                            <tr>
                                                <td colspan="4" class="text-start"> <h4>Total Number Of Points: </h4></td>
                                                <td>${data.seller_points_transactions[0].user_seller.points_balance}</td>
                                            </tr>
                                        `;
                            $('#orderDetailsBody').append(balanceRow);
                        } else {
                            console.log('Order not found');
                        }
                    },
                    error: function(e) {
                        console.log(e.responseText);
                    }
                });
            });

        });
    </script>
@endsection
