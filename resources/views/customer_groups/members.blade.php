@extends('layouts.app')

@section('styles')
<style>
    #customer-groups-table_length select{
        /*     style   for show entries field */
        width: 100px;
    }
</style>
@endsection

@section('content')

<div class="container">
    <h2>
        {{App\Models\CustomerGroup::where('id',$group_id)->first()->group_name}}</h2>
    <p>
        <strong>No of members</strong>
    
    {{App\Models\CustomerGroupMember::where('customer_group_id', '=', $group_id)->count()}}
</p>
        <h1>Members</h1>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link " href="#upload-list" data-toggle="tab">Upload List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#personality" data-toggle="tab">Personality</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#card-no" data-toggle="tab">Card No</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#customer-group-members" data-toggle="tab">Customer group Members</a>
            </li>
        </ul>

        <div class="tab-content mt-3">
            <div class="tab-pane fade" id="upload-list">
                <form action="{{ route('customer-groups.members.uploadFile') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">Select a file</label>
                        <input type="file" class="form-control-file" id="file" name="file">
                        @error('file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <input type="hidden" name="customer_group_id" value="{{ $group_id }}">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
            <div class="tab-pane fade" id="personality">
                <h3>Personality Content</h3>
                <form action="{{ route('customer-groups.members.personality') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="birth-year">Birth Year</label>
                        <select class="form-control" id="birth-year" name="birth_year">
                            @php
                                $currentYear = date('Y');
                                $startYear = 1925;
                                $endYear = $currentYear - 5;
                            @endphp
                            @for ($year = $startYear; $year <= $endYear; $year++)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <input type="hidden" name="customer_group_id" value="{{ $group_id }}">
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
                <!-- Other content for the Personality tab edited -->
            </div>
            <div class="tab-pane fade" id="card-no">
                <form action="{{ route('customer-groups.members.cardno') }}" method="POST">
                    @csrf

                    <h3>Card No Content</h3>
                    <div class="form-group">
                        <label for="card-from">From</label>
                        <input type="text" class="form-control" id="card-from" name="card_no_start">
                    </div>
                    <div class="form-group">
                        <label for="card-to">To</label>
                        <input type="text" class="form-control" id="card-to" name="card_no_end">
                    </div>
                    <input type="hidden" name="customer_group_id" value="{{ $group_id }}">
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>

            <div class="tab-pane fade show active" id="customer-group-members">
                <h1>Customer Group members</h1>

                <table id="customer-groups-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Customer Code</th>
                            <th>Gender</th>
                            <th>Customer Code</th>
                            <th>Customer Tel 1</th>
                            <th>Customer Email</th>
                            <th>Address</th>
                            <th>created By</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#customer-groups-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('customer-group.members', $group_id) }}",
                columns: [
                    { data: 'id', name: 'id' },
                    // {
                    //     data: 'group_name',
                    //     name: 'customer_group.group_name'
                    // },
                    {
                        data: 'customer_name',
                        name: 'customer.name'
                    },
                    {
                        data: 'customer_code',
                        name: 'customer.code'
                    },
                    {
                        data: 'customer_gender',
                        name: 'customer.gender'
                    },
                    {
                        data: 'customer_code',
                        name: 'customer.code'
                    },
                    {
                        data: 'customer_tel1',
                        name: 'customer.tel1'
                    },
                    {
                        data: 'customer_email',
                        name: 'customer.email'
                    },
                    {
                        data: 'customer_address',
                        name: 'customer.address'
                    },
                    {
                        data: 'user',
                        name: 'user.name'
                    }
                ]
            });
        });
    </script>
@endsection
