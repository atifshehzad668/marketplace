@extends('layouts.app')
@section('styles')
    <style>
        .leads_information {
            margin-top: 30px;
            border-bottom: 2px solid #000;
        }
    </style>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="card-header justify-content-center text-center">Leads Information</h5>
                </div>
                <div class="col-md-12 ">
                    <div class="container">
                        <table class="table" id="mytable">
                            <thead>
                                <tr>
                                    <th>Lead Number</th>
                                    <th>Vehicle</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>{{ $lead->lead_number }}</td>
                                    <td>{{ $lead->lead_vehicle }}</td>
                                    <td>{{ $lead->customer->name }}</td>
                                    <td>{{ $lead->customer->phone }}</td>
                                    <td>{{ $lead->customer->email }}</td>
                                    <td>
                                        @if ($lead->lead_status == 0)
                                            Pending
                                        @elseif($lead->lead_status == 1)
                                            Accepted
                                        @elseif($lead->lead_status == 2)
                                            Closed
                                        @else
                                            Unknown Status
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-md-12 leads_information"></div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <h5 class="card-header justify-content-center text-center">Vehicle Information</h5>
                </div>
                <div class="col-md-12 ">
                    <div class="container">
                        <table class="table" id="mytable">
                            <thead>
                                <tr>
                                    <th>Vehicle</th>
                                    <th>Vehicle Brand</th>
                                    <th>Modal</th>
                                    <th>year</th>
                                    <th>Mileage</th>
                                    <th>Date of Sale</th>
                                    <th>Sale Representation</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>{{ $lead->vehicle->vehicle }}</td>
                                    <td>{{ $lead->vehicle->vehicle_brand }}</td>

                                    <td>{{ $lead->vehicle->model }}</td>
                                    <td>{{ $lead->vehicle->year }}</td>
                                    <td>{{ $lead->vehicle->mileage }}</td>
                                    <td>{{ $lead->vehicle->date_of_sale }}</td>
                                    <td>{{ $lead->vehicle->sale_rep }}</td>


                                </tr>
                            </tbody>
                        </table>
                        <div class="col-md-12 leads_information"></div>
                    </div>
                </div>
            </div>





            <div class="row">
                <div class="col-md-12">
                    <h5 class="card-header justify-content-center text-center">Customer Information</h5>
                </div>
                <div class="col-md-12 ">
                    <div class="container">
                        <table class="table" id="mytable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Occupation</th>
                                    <th>Date of Birth</th>

                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td>{{ $lead->customer->name }}</td>
                                    <td>{{ $lead->customer->phone }}</td>
                                    <td>{{ $lead->customer->email }}</td>
                                    <td>{{ $lead->customer->address }}</td>
                                    <td>{{ $lead->customer->occupation }}</td>
                                    <td>{{ $lead->customer->dob }}</td>



                                </tr>
                            </tbody>
                        </table>
                        <div class="col-md-12 leads_information"></div>
                    </div>
                </div>
            </div>



            <div class="col-md-12 mt-5 mb-5 d-flex justify-content-center">
                <button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Conversation</button>
            </div>






        </div>




        <hr>
        <!--/ Basic Bootstrap Table -->
    </div>

    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{ route('saleman.conversation.store', $lead->id) }}" method="POST"
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
