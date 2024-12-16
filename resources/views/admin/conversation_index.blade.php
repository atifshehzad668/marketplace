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
                            <th>Date</th>
                            <th>Attachment</th>
                            <th>Action</th>


                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($conversations as $conversation)
                            <tr>
                                <td>{{ $conversation->title }}</td>
                                <td>{{ $conversation->description }}</td>
                                <td>{{ $conversation->date_time }}</td>
                                <td><img src="{{ asset($conversation->attachment) }}" alt="" height="100px"
                                        width="100px" style="border-radius: 10%;"></td>

                                <td>
                                    <!-- Edit Button -->

                                    <a href="#" class="btn btn-primary btn-sm me-2 editconversation"
                                        data-id="{{ $conversation->id }}" data-toggle="modal"
                                        data-target=".edit-conversation-modal-sm">
                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.conversation.destroy', $conversation->id) }}"
                                        method="POST" id="delete-lead-form-{{ $conversation->id }}"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmLeadDelete({{ $conversation->id }})">
                                            <i class="bx bx-trash me-1"></i> Delete
                                        </button>
                                    </form>


                                </td>
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
                                <input type="text" id="title_add" name="title" class="form-control" required
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
                                <input type="text" id="description_add" required name="description" class="form-control"
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
                                <input type="date" id="date_time_add" required name="date_time" class="form-control"
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
                                <input type="file" id="attachment_add" name="attachment" class="form-control"
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
    <div class="modal fade edit-conversation-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Vehicle Name -->
                        <input type="hidden" id="edit_id" name="edit_id" />

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
                                <span class="input-group-text"><i class="bx bx-paperclip"></i></span>
                                <!-- Changed icon -->
                                <input type="file" id="attachment" name="attachment" class="form-control"
                                    placeholder="attachment" value="{{ old('attachment') }}" />
                            </div>
                            <div id="attachment-preview"></div>
                            @error('attachment')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>




                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary update_conversation">Update Conversation</button>
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


@section('customjs')
    <script>
        $("#mytable").on("click", ".editconversation", function(e) {
            e.preventDefault();

            let conversationId = $(this).data("id");
            $("#edit_id").val(conversationId); // Get the conversation ID
            $("#title").val('');
            $("#description").val('');
            $("#date_time").val('');
            $("#attachment-preview").html('');
            $.ajax({
                type: "GET",
                url: "{{ route('admin.conversation.edit') }}",
                data: {
                    id: conversationId
                },
                success: function(data) {
                    // Populate modal fields with the retrieved data
                    $("#title").val(data.conversation.title);
                    $("#description").val(data.conversation.description);
                    $("#date_time").val(data.conversation.date_time);


                    // Display the existing image below the file input
                    if (data.conversation.attachment) {
                        $("#attachment-preview").html(`
                         <img src="{{ asset('${data.conversation.attachment}') }}" alt="Attachment" class="img-thumbnail mt-2" width="100" />

                `);
                    } else {
                        $("#attachment-preview").html("");
                    }

                    // Show the modal
                    $(".edit-conversation-modal-sm").modal("show");
                },
                error: function(err) {
                    console.log(err.responseText);
                }
            });
        });





        $(".edit-conversation-modal-sm").on("click", ".update_conversation", function(e) {
            e.preventDefault();

            // Gather form data
            var formData = new FormData();
            formData.append("id", $("#edit_id").val()); // Hidden field for conversation ID
            formData.append("title", $("#title").val());
            formData.append("description", $("#description").val());
            formData.append("date_time", $("#date_time").val());

            // Check if a file is selected
            if ($("#attachment")[0].files.length > 0) {
                formData.append("attachment", $("#attachment")[0].files[0]);
            }

            // AJAX setup
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });

            // AJAX request
            $.ajax({
                type: "POST",
                url: "{{ route('admin.conversation.update') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        // Hide the modal first, then show the success Swal message
                        $(".edit-conversation-modal-sm").modal("hide");


                        Swal.fire({
                            title: "Success!",
                            text: response.message, // Server-side message
                            icon: "success",
                            confirmButtonText: "OK",
                            timer: 3000, // 1 second delay
                            timerProgressBar: true, // Optional: Adds a progress bar

                        });
                        window.location.reload();

                    } else {
                        console.log("Error updating conversation:", response.message);
                    }
                },
                error: function(err) {
                    console.log("AJAX Error:", err.responseText);
                    Swal.fire({
                        title: "Error!",
                        text: "Something went wrong. Please try again.",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            });
        });

        function confirmLeadDelete(leadId) {
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
                    document.getElementById(`delete-lead-form-${leadId}`).submit();
                }
            });
        }
    </script>
@endsection
