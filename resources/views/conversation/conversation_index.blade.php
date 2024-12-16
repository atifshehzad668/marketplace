@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-header">Leads Conversation</h5>
                </div>
                <div class="col-md-5 ">
                    <button class="btn btn-primary float-end mt-5 " data-toggle="modal" data-target=".bd-example-modal-sm">Add
                        Conversation</button>
                </div>

            </div>
            <div class="table-responsive text-nowrap">
                <table class="table" id="mytable">
                    <thead>
                        <tr>
                            <th>Title </th>
                            <th>Description</th>
                            <th>Attachment</th>


                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($conversations as $conversation)
                            <tr>
                                <td>{{ $conversation->title }}</td>
                                <td>{{ $conversation->description }}</td>
                                <td><img src="{{ asset($conversation->attachment) }}" alt="" height="100px"
                                        width="100px" style="border-radius: 10%;"></td>

                                {{-- <td>
                                    <!-- Edit Button -->

                                    <a href="javascript:void(0);" data-toggle="modal" data-target=".bd-example-modal-sm"
                                        class="btn btn-warning btn-sm me-2 view-lead" data-lead-id="{{ $lead->id }}">
                                        <i class="bx bx-edit-alt me-1"></i> View
                                    </a>


                                </td> --}}
                            </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>
        </div>







    </div>


    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{ route('saleman.conversation.store', $conversation->lead_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Vehicle Name -->
                        <div class="mb-6">
                            <label class="form-label" for="title">Title</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-pencil"></i></span> <!-- Changed icon -->
                                <input type="text" id="title" name="title" class="form-control" required
                                    placeholder="title" value="{{ old('title') }}" />
                            </div>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="form-label" for="description">Description</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-edit"></i></span> <!-- Changed icon -->
                                <input type="text" id="description" required name="description" class="form-control"
                                    placeholder="description" value="{{ old('description') }}" />
                            </div>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="date_time">date_time</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-edit"></i></span> <!-- Changed icon -->
                                <input type="date" id="date_time" required name="date_time" class="form-control"
                                    placeholder="date_time" value="{{ old('date_time') }}" />
                            </div>
                            @error('date_time')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="form-label" for="attachment">Attachment</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-paperclip"></i></span> <!-- Changed icon -->
                                <input type="file" id="attachment" name="attachment" class="form-control"
                                    placeholder="attachment" value="{{ old('attachment') }}" />
                            </div>
                            @error('attachment')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>




                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Save Conversation</button>
                    </form>
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
