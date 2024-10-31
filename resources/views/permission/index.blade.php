@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Permissions</h5>
            @can('permission-create')
                <a href="{{ route('permission.create') }}" class="btn btn-primary ml-4 col-md-3 mb-4">Create Permission</a>
            @endcan

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
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            @can('permission-edit')
                                                <a class="dropdown-item" href="{{ route('permission.edit', $permission->id) }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>
                                            @endcan


                                            @can('permission-delete')
                                                <form action="{{ route('permission.destroy', $permission->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </button>
                                                </form>
                                            @endcan


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
        {{ $permissions->links() }}
        <!--/ Basic Bootstrap Table -->


    </div>

    @if (Session::has('success'))
        <script>
            swal("Good job!", "{{ Session::get('success') }}", "success");
        </script>
    @endif
@endsection
