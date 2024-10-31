@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Roles</h5>

            {{-- Create Role Button, visible only if the user has 'role-create' permission --}}
            @can('role-create')
                <a href="{{ route('roles.create') }}" class="btn btn-primary ml-4 col-md-3 mb-4">Create Roles</a>
            @endcan

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
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        @canany(['role-edit', 'role-delete'])
                                            <div class="dropdown-menu">

                                                {{-- Edit button, visible only if the user has 'role-edit' permission --}}
                                                @can('role-edit')
                                                    <a class="dropdown-item" href="{{ route('roles.edit', $role->id) }}">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>
                                                @endcan

                                                {{-- Delete button, visible only if the user has 'role-delete' permission --}}
                                                @can('role-delete')
                                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="bx bx-trash me-1"></i> Delete
                                                        </button>
                                                    </form>
                                                @endcan

                                            </div>
                                        </div>
                                    @endcan
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
