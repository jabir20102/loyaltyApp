@extends('layouts.app')

@section('content')
    <h1>Update Type</h1>
    <form action="{{ route('category.update',$category->id) }}" method="POST">
            
        @csrf
        @method('PUT')
            
            <div class="form-group">
                <label for="category_name">Type Name</label>
                <input type="text" name="category_name" id="category_name" class="form-control @error('category_name') is-invalid @enderror" value="{{ $category->category_name }}" required>
                @error('category_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
                
    <button type="submit" class="btn btn-primary mt-3">Update</button>
            
    
</form>
@endsection
