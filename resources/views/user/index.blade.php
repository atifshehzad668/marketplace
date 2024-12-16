@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-header">Users</h5>
                </div>
                <div class="col-md-5 mt-5 ">
                    @can('user-create')
                        <a href="{{ route('users.create') }}" class="btn btn-primary ml-4 col-md-3 mb-4 float-end">Create User</a>
                    @endcan
                </div>
            </div>






            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Email</th>

                            <th>Role</th>
                            <th>Status</th>
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
                                <td> <span>{{ $user->name }}</span></td>
                                <td> <span>{{ $user->email }}</span></td>


                                <td> <span>{{ $user->roles->pluck('name')->implode(', ') }}</span></td>


                                <td><span class="badge bg-label-primary me-1">Active</span></td>
                                <td>
                                    @canany(['user-edit', 'user-delete'])
                                        <div class="d-flex">
                                            {{-- Edit button, visible only if the user has 'user-edit' permission --}}
                                            @can('user-edit')
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary me-2">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                            @endcan

                                            {{-- Delete button, visible only if the user has 'user-delete' permission  --}}
                                            @can('user-delete')
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    id="delete-form-{{ $user->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="confirmDelete({{ $user->id }})">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </button>
                                                </form>
                                            @endcan

                                        </div>
                                    @endcanany

                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>
        </div>
        <hr class="my-12" />
        {{ $users->links() }}
        <!--/ Basic Bootstrap Table -->





    </div>

    @if (Session::has('success'))
        <script>
            swal("Good job!", "{{ Session::get('success') }}", "success");
        </script>
    @endif
@endsection
@section('customjs')
    <script>
        function confirmDelete(userId) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${userId}`).submit();
                }
            });
        }
    </script>
@endsection
