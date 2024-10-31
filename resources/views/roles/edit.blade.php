@extends('layouts.app')

@section('content')
    <form action="{{ route('roles.update', $role->id) }}" method="POST" enctype="multipart/form-data">
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
                                        value="{{ old('name', $role->name) }}" placeholder="John Doe" />
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                @if ($permissions->isNotEmpty())
                                    @foreach ($permissions as $permission)
                                        <div class="col-md-3 mt-3"> <!-- col-md-3 for 4 items per row -->
                                            <input type="checkbox" id="permission-{{ $permission->id }}" name="permission[]"
                                                class="rounded" value="{{ $permission->name }}"
                                                {{ $haspermissions->contains($permission->name) ? 'checked' : '' }}>
                                            <label for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                        </div>
                                    @endforeach
                                @endif
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
@endsection
