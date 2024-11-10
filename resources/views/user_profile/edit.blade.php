@extends('layouts.app')

@section('content')
    <form action="{{ route('user.profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Layout -->
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-6">
                        <div class="card-body">
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" id="basic-default-name"
                                        placeholder="John Doe" value="{{ old('name', $user->name) }}" />
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-email">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" id="basic-default-email"
                                        placeholder="example@example.com" value="{{ old('email', $user->email) }}" />
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="profile-image">Profile Image</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="profile_image" id="profile-image"
                                        accept="image/*" />
                                    @if ($user->profile_image)
                                        <div class="mt-2">
                                            <img src="{{ asset($user->profile_image) }}" alt="Profile Image" width="100"
                                                height="100" class="img-thumbnail">

                                        </div>
                                    @endif
                                    @error('profile_image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-password">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password" id="basic-default-password"
                                        placeholder="Password" />
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

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-contact">Contact</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="contact" id="basic-default-contact"
                                        placeholder="Contact" value="{{ old('contact', $user->contact) }}" />
                                    @error('contact')
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
