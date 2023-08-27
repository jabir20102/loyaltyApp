@extends('layouts.app')

@section('content')
    <a href="{{ route('category.create') }}" class="btn btn-primary mb-3">Add New Category</a>
    <h1>Categories</h1>
    
    <div class="table-responsive">
    <table class="table table-striped table-bordered">
        
        <thead>
            <tr>
                <th>Type ID</th>
                <th>Category Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->category_name }}</td>
                    <td>
                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this category?')">
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
