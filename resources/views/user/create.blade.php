@extends('layouts.app')

@section('content')
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-6">
                    <h5 style="color: rgb(105, 108, 255); font-family:georgia; font-size: 1.75rem;letter-spacing: -0.5px;"
                        class="card-header">Create Salesman</h5>
                </div>

            </div>
            <!-- Basic Layout -->
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-6">
                        <div class="card-body">
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" id="basic-default-name"
                                        placeholder="John Doe" value="" />
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-email">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="email" id="basic-default-email"
                                        placeholder="example@example.com" value="" />
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-password">Password</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="password" id="basic-default-password"
                                        placeholder="example@example.com" value="" />
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-password-confirmation">Confirm
                                    Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="basic-default-password-confirmation" placeholder="Re-enter your password" />
                                    @error('password_confirmation')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            {{-- <div class="row">
                                @if ($roles->isNotEmpty())
                                    @foreach ($roles as $role)
                                        <div class="col-md-3 mt-3"> <!-- col-md-3 for 4 items per row -->
                                            <input type="checkbox" id="role-{{ $role->id }}" name="role[]"
                                                class="rounded" value="{{ $role->name }}"
                                                {{ in_array($role->name, $hasroles) ? 'checked' : '' }} />
                                            <!-- Check if role is selected -->
                                            <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div> --}}


                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
