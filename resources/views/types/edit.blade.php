@extends('layouts.app')

@section('content')
    <h1>Update Type</h1>
    <form action="{{ route('types.update',$type->id) }}" method="POST">
            
        @csrf
        @method('PUT')
            
            <div class="form-group">
                <label for="type_name">Type Name</label>
                <input type="text" name="type_name" id="type_name" class="form-control @error('type_name') is-invalid @enderror" value="{{ $type->type_name }}" required>
                @error('type_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
                
    <button type="submit" class="btn btn-primary mt-3">Update</button>
            
    
</form>
@endsection
