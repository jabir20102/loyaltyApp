@extends('layouts.app')

@section('styles')
    <style>
        #DataTables_Table_0_length select {
            /*     style   for show entries field */
            width: 100px;
        }
    </style>
@endsection
@section('content')
    <h1>Registered Users</h1>
    <a href="{{ route('users.create') }}" class="btn btn-success mb-2" title="Add a new User">
        <i class="fas fa-user-plus"></i> Add a New Customer</a>
            
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created at</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <script type="text/javascript">
        $(function() {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ],
                "columnDefs": [{

                    "targets": [3], // Indexes of the "dates" column
                    "render": function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            return moment(data).format(
                                'DD/MM/YYYY'); // Use your desired date format
                        }
                        return data;
                    }
                }],
            });

        });
    </script>
@endsection
