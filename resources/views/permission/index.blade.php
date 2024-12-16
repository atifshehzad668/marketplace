@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="row">
                <div class="col-md-4">
                    <h5 class="card-header">Permissions</h5>
                </div>
                <div class="col-md-6 mt-5 mr-4">
                    @can('permission-create')
                        <a href="{{ route('permission.create') }}" class="btn btn-primary ml-4 col-md-3 mb-4 float-end">
                            Create Permission
                        </a>
                    @endcan
                </div>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            {{-- <th>Client</th> --}}
                            {{-- <th>Users</th> --}}
                            {{-- <th>Status</th> --}}
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($permissions as $permission)
                            <tr>
                                <td> <span>{{ $permission->name }}</span></td>
                                {{-- <td>Albert Cook</td> --}}
                                {{-- <td>
                                <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        class="avatar avatar-xs pull-up" title="Lilian Fuller">
                                        <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                                    </li>
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        class="avatar avatar-xs pull-up" title="Sophia Wilkerson">
                                        <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                                    </li>
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        class="avatar avatar-xs pull-up" title="Christina Parker">
                                        <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
                                    </li>
                                </ul>
                            </td> --}}
                                {{-- <td><span class="badge bg-label-primary me-1">Active</span></td> --}}
                                <td>
                                    @canany(['permission-edit', 'permission-delete'])
                                        <div class="d-flex">
                                            {{-- Edit button, visible only if the user has 'permission-edit' permission --}}
                                            @can('permission-edit')
                                                <a href="{{ route('permission.edit', $permission->id) }}"
                                                    class="btn btn-sm btn-primary me-2">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                            @endcan

                                            {{-- Delete button, visible only if the user has 'permission-delete' permission --}}
                                            @can('permission-delete')
                                                <form action="{{ route('permission.destroy', $permission->id) }}" method="POST"
                                                    id="delete-permission-form-{{ $permission->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="confirmPermissionDelete({{ $permission->id }})">
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
        {{ $permissions->links() }}
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
        function confirmPermissionDelete(permissionId) {
            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-permission-form-${permissionId}`).submit();
                }
            });
        }
    </script>
@endsection
