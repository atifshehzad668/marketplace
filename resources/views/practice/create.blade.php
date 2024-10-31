@extends('layouts.app')

@section('content')
    <form action="{{ route('practice.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Layout -->
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-6">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Basic Layout</h5>
                            <small class="text-muted float-end">Default label</small>
                        </div>
                        <div class="card-body">
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" id="basic-default-name"
                                        placeholder="John Doe" />
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-email">Email</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="basic-default-email" name="email" class="form-control"
                                            placeholder="john.doe" aria-label="john.doe"
                                            aria-describedby="basic-default-email2" />
                                        <span class="input-group-text" id="basic-default-email2">@example.com</span>
                                    </div>
                                    <div class="form-text">You can use letters, numbers & periods</div>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-password">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" id="basic-default-password" name="password" class="form-control"
                                        placeholder="Enter your password" />
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        swal("Good job!", "Form Submitted Successfully!", "error");
    </script>
@endsection
