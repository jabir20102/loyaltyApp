@extends('layouts.app')

@section('styles')
    <style>
        #stock-cluster-table_length select {
            /*     style   for show entries field */
            width: 100px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h3>
            {{ App\Models\StockCluster::where('id', $cluster_id)->first()->cluster_name }}
        </h3>



        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link " href="#upload-list" data-toggle="tab">Upload List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#included-groups" data-toggle="tab">Included Groups</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#included-subgroups" data-toggle="tab">Included Sub Groups</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#excluded-groups" data-toggle="tab">Excluded Groups</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn btn-primary" href="#excluded-subgroups" data-toggle="tab">Excluded Sub Groups</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#groups-contents" data-toggle="tab">Groups Contents</a>
            </li>
        </ul>

        <div class="tab-content mt-3">
            <div class="tab-pane fade" id="upload-list">
                <form action="{{ route('stock-clusters.members.uploadFile') }}" method="POST"
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

                    <input type="hidden" name="stock_cluster_id" value="{{ $cluster_id }}">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
            <div class="tab-pane fade" id="included-groups">

                <a href="{{ route('includedGroupes.create', $cluster_id) }}" class="btn btn-primary mb-3">Add Included
                    Group</a>


                <div class="table-responsive">
                    <table class="table table-striped table-bordered">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Created by</th>
                                <th>Group name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($includedGroupes as $group)
                                <tr>
                                    <td>{{ $group->id }}</td>
                                    <td>{{ $group->created_by }}</td>
                                    <td>{{ $group->group_name }}</td>
                                    <td>

                                        <form action="{{ route('includedGroupes.destroy', $group) }}" method="POST"
                                            style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this type?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="tab-pane fade" id="included-subgroups">
                <a href="{{ route('includedSubGroupes.create', $cluster_id) }}" class="btn btn-primary mb-3">Add Included
                    Sub
                    Group</a>


                <div class="table-responsive">
                    <table class="table table-striped table-bordered">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Created by</th>
                                <th>Sub Group name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($includedSubGroupes as $group)
                                <tr>
                                    <td>{{ $group->id }}</td>
                                    <td>{{ $group->created_by }}</td>
                                    <td>{{ $group->subgroup_name }}</td>
                                    <td>

                                        <form action="{{ route('includedSubGroupes.destroy', $group) }}" method="POST"
                                            style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this type?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="excluded-groups">
                <a href="{{ route('excludedGroupes.create', $cluster_id) }}" class="btn btn-primary mb-3">Add Excluded
                    Group</a>


                <div class="table-responsive">
                    <table class="table table-striped table-bordered">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Created by</th>
                                <th>Group name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($excludedGroupes as $group)
                                <tr>
                                    <td>{{ $group->id }}</td>
                                    <td>{{ $group->created_by }}</td>
                                    <td>{{ $group->group_name }}</td>
                                    <td>

                                        <form action="{{ route('excludedGroupes.destroy', $group) }}" method="POST"
                                            style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this type?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="excluded-subgroups">
                <a href="{{ route('excludedSubGroupes.create', $cluster_id) }}" class="btn btn-primary mb-3">Add Excluded
                    Sub
                    Group</a>


                <div class="table-responsive">
                    <table class="table table-striped table-bordered">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Created by</th>
                                <th>Group name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($excludedSubGroupes as $group)
                                <tr>
                                    <td>{{ $group->id }}</td>
                                    <td>{{ $group->created_by }}</td>
                                    <td>{{ $group->subgroup_name }}</td>
                                    <td>

                                        <form action="{{ route('excludedSubGroupes.destroy', $group) }}" method="POST"
                                            style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this type?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade  show active" id="groups-contents">
                <h3>Groups Contents</h3>
                <table id="stock-cluster-table" class="table table-striped table-bordered" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cluster Name</th>
                            <th>Cluster Code</th>
                            <th>Updated at</th>
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
            $('#stock-cluster-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('stock-cluster.members', $cluster_id) }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'stock_cluster_name',
                        name: 'stock_cluster_name'
                    },
                    {
                        data: 'stock_code',
                        name: 'stock_code'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                ],
                "columnDefs": [{
                    "targets": [3], // Indexes of the "dates" column
                    "render": function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            return moment(data).format(
                                'YYYY-MM-DD'); // Use your desired date format
                        }
                        return data;
                    }
                }]
            });
        });
    </script>
@endsection
