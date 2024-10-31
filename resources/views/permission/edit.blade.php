@extends('layouts.app')

@section('content')
    <form action="{{ route('permission.update', $permission->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Layout -->
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-6">
                        {{-- <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Basic Layout</h5>
                            <small class="text-muted float-end">Default label</small>
                        </div> --}}
                        <div class="card-body">
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ old('name', $permission->name) }}" class="form-control"
                                        name="name" id="basic-default-name" placeholder="John Doe" />

                                </div>
                            </div>



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
