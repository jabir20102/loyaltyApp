@extends('layouts.app')

@section('content')
    <h1>Add Type</h1>
    <form action="{{ route('types.store') }}" method="POST">
            
        @csrf
    
            
            <div class="form-group">
                <label for="type_name">Type Name</label>
                <input type="text" name="type_name" id="type_name" class="form-control @error('type_name') is-invalid @enderror" value="{{ old('cc_card_no') }}" required>
                @error('type_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
                
    <button type="submit" class="btn btn-primary mt-3">Create</button>
            
    
</form>
@endsection
