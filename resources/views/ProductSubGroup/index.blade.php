@extends('layouts.app')

@section('content')
    <a href="{{ route('productSubGroup.create') }}" class="btn btn-primary mb-3">Add New Product Sub Group</a>
    <h1>Product Sub Groups</h1>
    
    <div class="table-responsive">
    <table class="table table-striped table-bordered">
        
        <thead>
            <tr>
                <th>Product Sub Group ID</th>
                <th>Product Sub Group Name</th>
                <th>Product Group Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productSubGroupes as $productSubGroup)
                <tr>
                    <td>{{ $productSubGroup->id }}</td>
                    <td>{{ $productSubGroup->sub_group_name }}</td>
                    <td>{{ $productSubGroup->group->group_name }}</td>
                    <td>
                        <a href="{{ route('productSubGroup.edit', $productSubGroup->id) }}" class="btn btn-primary btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('productSubGroup.destroy', $productSubGroup->id) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this sub group?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
