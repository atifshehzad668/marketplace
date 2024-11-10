@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Regions</h5>
            {{-- @can('permission-create') --}}
            <a href="{{ route('regions.create') }}" class="btn btn-primary ml-4 col-md-3 mb-4">Create Region</a>
            {{-- @endcan --}}

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Region Name</th>
                            <th>City Name</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($regions as $region)
                            <tr>
                                <td> <span>{{ $region->region_name }}</span></td>
                                <td> <span>{{ $region->city->city_name }}</span></td>


                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            {{-- @can('region-edit') --}}
                                            <a class="dropdown-item" href="{{ route('regions.edit', $region->id) }}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </a>
                                            {{-- @endcan --}}


                                            {{-- @can('region-delete') --}}
                                            <form action="{{ route('regions.destroy', $region->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">
                                                    <i class="bx bx-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                            {{-- @endcan --}}


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
        {{ $regions->links() }}
        <!--/ Basic Bootstrap Table -->


    </div>

    @if (Session::has('success'))
        <script>
            swal("Good job!", "{{ Session::get('success') }}", "success");
        </script>
    @endif
@endsection
