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
    <h1>Customer Groups</h1>
    <div class="mb-3">
        <a href="{{ route('customer-groups.create') }}" class="btn btn-success">Add Group</a>
    </div>
    <table id="customer-groups-table" class="table table-striped table-bordered">
        <thead>
            <tr>
                {{-- <th>ID</th> --}}
                <th>User Group Name</th>
                <th>Is Active</th>
                <th>Notes</th>
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
            $('#customer-groups-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('customer-groups.index') }}",
                columns: [
                    // { data: 'id', name: 'id' },
                    {
                        data: 'group_name',
                        name: 'group_name'
                    },
                    {
                        data: 'isActive',
                        name: 'isActive',
                        render: function(data) {
                            return data == 1 ? 'Yes' : 'No';
                        }
                    },
                    {
                        data: 'notes',
                        name: 'notes'
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
