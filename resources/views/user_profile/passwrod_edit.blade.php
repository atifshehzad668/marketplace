@extends('layouts.app')

@section('content')
    <form action="{{ route('user.password.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Layout -->
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-6">
                        <div class="card-body">


                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-password">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" value="{{ $user->password }}" class="form-control"
                                        name="password" id="basic-default-password" placeholder="Password" />
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-password-confirm">Confirm
                                    Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="basic-default-password-confirm" placeholder="Confirm Password" />
                                    @error('password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>



                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @if (Session::has('success'))
        <script>
            swal("Good job!", "{{ Session::get('success') }}", "success");
        </script>
    @endif
@endsection
