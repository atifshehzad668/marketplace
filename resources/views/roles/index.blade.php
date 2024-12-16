@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-header">Roles</h5>
                </div>
                <div class="col-md-5 mt-5 mr-4">
                    @can('role-create')
                        <a href="{{ route('roles.create') }}" class="btn btn-primary ml-4 col-md-3 mb-4 float-end">
                            Create Role
                        </a>
                    @endcan
                </div>
            </div>


            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Role</th>
                            <th>Permission</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($roles as $role)
                            <tr>
                                <td><span>{{ $role->name }}</span></td>
                                <td><span>{{ $role->permissions->pluck('name')->implode(', ') }}</span></td>
                                <td>
                                    @canany(['role-edit', 'role-delete'])
                                        <div class="d-flex">
                                            {{-- Edit button, visible only if the user has 'role-edit' permission --}}
                                            @can('role-edit')
                                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary me-2">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                            @endcan

                                            {{-- Delete button, visible only if the user has 'role-delete' permission --}}
                                            @can('role-delete')
                                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                                    id="delete-role-form-{{ $role->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="confirmRoleDelete({{ $role->id }})">
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
        {{ $roles->links() }}
        <!--/ Basic Bootstrap Table -->
    </div>

    {{-- Success Message --}}
    @if (Session::has('success'))
        <script>
            swal("Good job!", "{{ Session::get('success') }}", "success");
        </script>
    @endif
@endsection

@section('customjs')
    <script>
        function confirmRoleDelete(roleId) {
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
                    document.getElementById(`delete-role-form-${roleId}`).submit();
                }
            });
        }
    </script>
@endsection
