@extends('layouts.app')

@section('content')
    <h1>Add Category</h1>
    <form action="{{ route('category.store') }}" method="POST">
            
        @csrf
    
            
            <div class="form-group">
                <label for="category_name">Type category name</label>
                <input type="text" name="category_name" id="category_name" class="form-control @error('category_name') is-invalid @enderror" value="{{ old('cc_card_no') }}" required>
                @error('category_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
                
    <button type="submit" class="btn btn-primary mt-3">Create</button>
            
    
</form>
@endsection
