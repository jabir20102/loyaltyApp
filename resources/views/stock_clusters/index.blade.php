@extends('layouts.app')

@section('styles')
<style>
    #stock-clusters-table_length select{
        /*     style   for show entries field */
        width: 100px;
    }
</style>
@endsection

@section('content')
    <h1>Stock Clusters</h1>
    <div class="mb-3">
        <a href="{{ route('stock-clusters.create') }}" class="btn btn-success">Add Stock Cluster</a>
    </div>
    <table id="stock-clusters-table" class="table table-striped table-bordered">
        <thead>
            <tr>
                {{-- <th>ID</th> --}}
                <th>Stock Cluster Name</th>
                <th>Created By</th>
                <th>Is Active</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#stock-clusters-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('stock-clusters.index') }}",
                columns: [
                    // { data: 'id', name: 'id' },
                    {
                        data: 'cluster_name',
                        name: 'cluster_name'
                    },
                    {
                        data: 'created_by',
                        name: 'created_by'
                    },
                    {
                        data: 'isActive',
                        name: 'isActive',
                        render: function(data) {
                            return data == 1 ? 'Yes' : 'No';
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                createdRow: function(row, data, dataIndex) {
                    $(row).attr('data-id', data.id);
                },
                "columnDefs": [{
                    "targets": [ 3,4], // Indexes of the "dates" column
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
