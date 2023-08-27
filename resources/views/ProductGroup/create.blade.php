@extends('layouts.app')

@section('content')
    <h1>Add Product Group</h1>
    <form action="{{ route('productGroup.store') }}" method="POST">
            
        @csrf
    
            
            <div class="form-group">
                <label for="group_name">Product Group Name</label>
                <input type="text" name="group_name" id="group_name" class="form-control @error('group_name') is-invalid @enderror" value="{{ old('group_name') }}" required>
                @error('group_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
                
    <button type="submit" class="btn btn-primary mt-3">Create</button>
            
    
</form>
@endsection
