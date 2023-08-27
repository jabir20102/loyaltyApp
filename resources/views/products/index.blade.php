@extends('layouts.app')

@section('content')
    <h1>Products</h1>

    <div class="mb-3">
        <a href="{{ route('products.create') }}" class="btn btn-success">Add product</a>
        <a href="{{ route('products.export') }}" class="btn btn-primary">
            <i class="fas fa-file-excel"></i> Export Products
        </a>
    </div>
    
    <table id="samples-table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Code</th>                
                <th>type id</th>
                <th>special_code1</th>
                <th>Category Id</th>
                <th>Group Name</th>
                <th>Sub Group  Name</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>

    <script>
        $(function () {
            $('#samples-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('products.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'code', name: 'code'},
                    {data: 'type_id', name: 'type_id'},
                    {data: 'special_code1', name: 'special_code1'},
                    {data: 'category_id', name: 'category_id'},
                    {data: 'product_group_id', name: 'product_group_id'},
                    {data: 'product_subgroup_id', name: 'product_subgroup_id'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false}
                ],
                createdRow: function (row, data, dataIndex) {
                    $(row).attr('data-id', data.id);
                },
                "columnDefs": [
            {
                "targets": [8,9], // Indexes of the "dates" column
                "render": function(data, type, row) {
                    if (type === 'display' || type === 'filter') {
                        return moment(data).format('YYYY-MM-DD'); // Use your desired date format
                    }
                    return data;
                }
            }
        ]
            });
        });
    </script>
@endsection
