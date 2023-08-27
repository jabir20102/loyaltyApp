@extends('layouts.app')

@section('content')
    <a href="{{ route('productGroup.create') }}" class="btn btn-primary mb-3">Add New Product Group</a>
    <h1>Product Groups</h1>
    
    <div class="table-responsive">
    <table class="table table-striped table-bordered">
        
        <thead>
            <tr>
                <th>Product Group ID</th>
                <th>Product Group Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productGroupes as $productGroup)
                <tr>
                    <td>{{ $productGroup->id }}</td>
                    <td>{{ $productGroup->group_name }}</td>
                    <td>
                        <a href="{{ route('productGroup.edit', $productGroup->id) }}" class="btn btn-primary btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('productGroup.destroy', $productGroup->id) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this group?')">
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
