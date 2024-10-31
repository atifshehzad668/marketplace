@extends('layouts.app')


@section('content')
    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
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
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" id="basic-default-name"
                                        placeholder="John Doe" />
                                    @error('Title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-title">Content</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="content" id="basic-default-title" placeholder="Enter title here..." rows="3"></textarea>
                                    @error('content')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Author</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="author" id="basic-default-name"
                                        placeholder="John Doe" />
                                    @error('author')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
