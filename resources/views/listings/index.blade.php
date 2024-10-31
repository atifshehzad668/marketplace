@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Listings</h5>
            <a href="{{ route('listings.create') }}" class="btn btn-primary ml-4 col-md-3 mb-4">Create Listing</a>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Main Image</th>
                            <th>Headline</th>
                            <th>Quantity</th>
                            <th>Expiration Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 data-table">
                        @foreach ($listings as $listing)
                            <tr>
                                <td>
                                    @if ($listing->images->isNotEmpty())
                                        <img src="{{ asset('storage/' . $listing->images->first()->image_url) }}"
                                            alt="Main Image" style="width: 80px; height: auto;">
                                    @else
                                        <span>No image</span>
                                    @endif
                                </td>
                                <td>{{ $listing->headline }}</td>
                                <td>{{ $listing->quantity }}</td>
                                <td>{{ $listing->expiration_date }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('listings.edit', $listing->id) }}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </a>
                                            <a class="dropdown-item" href="{{ route('listings.show', $listing->id) }}">
                                                <i class="bx bx-eye-alt me-1"></i> Show
                                            </a>
                                            <form action="{{ route('listings.destroy', $listing->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">
                                                    <i class="bx bx-trash me-1"></i> Delete
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
    @if (Session::has('success'))
        <script>
            swal("Good job!", "{{ Session::get('success') }}", "success");
        </script>
    @endif
@endsection
{{-- @section('customjs')
    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('listings.list') }}",
                columns: [{
                        data: 'images',
                        name: 'images',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            if (data.length > 0) {
                                return '<img src="' + asset('storage/' + data[0].image_url) + '" ' +
                                    'alt="Main Image" ' +
                                    'style="width: 80px; height: auto; border-radius: 8px; border: 2px solid #ccc; box-shadow: 2px 2px 5px rgba(0,0,0,0.3);">';
                            } else {
                                return 'No image';
                            }
                        }
                    },
                    {
                        data: 'headline',
                        name: 'headline'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'expiration_date',
                        name: 'expiration_date'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });
        });
    </script>
@endsection --}}
