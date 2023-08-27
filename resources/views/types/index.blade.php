@extends('layouts.app')

@section('content')
    <a href="{{ route('types.create') }}" class="btn btn-primary mb-3">Add New Type</a>
    <h1>Types</h1>
    
    <div class="table-responsive">
    <table class="table table-striped table-bordered">
        
        <thead>
            <tr>
                <th>Type ID</th>
                <th>Type Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
                <tr>
                    <td>{{ $type->id }}</td>
                    <td>{{ $type->type_name }}</td>
                    <td>
                        <a href="{{ route('types.edit', $type->id) }}" class="btn btn-primary btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('types.destroy', $type->id) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this type?')">
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
