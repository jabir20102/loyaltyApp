@extends('layouts.app')

@section('content')
    <h1>Update Product Group</h1>
    <form action="{{ route('productGroup.update',$productGroup->id) }}" method="POST">
            
        @csrf
        @method('PUT')
            
            <div class="form-group">
                <label for="group_name">productGroup Name</label>
                <input type="text" name="group_name" id="group_name" class="form-control @error('group_name') is-invalid @enderror" value="{{ $productGroup->group_name }}" required>
                @error('group_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
                
    <button type="submit" class="btn btn-primary mt-3">Update</button>
            
    
</form>
@endsection
