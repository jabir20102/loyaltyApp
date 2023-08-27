@extends('layouts.app')

@section('content')
    <h1>Add Product</h1>

    <form action="{{ route('customer-groups.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="group_name">Group Name:</label>
            <input type="text" name="group_name" id="group_name"
                class="form-control @error('group_name') is-invalid @enderror" value="{{ old('group_name') }}">
            @error('group_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="isActive">Is Active</label>
            <input type="hidden" name="isActive" value="0"> <!-- Hidden input with value 0 -->
            <input type="checkbox" name="isActive" id="isActive" class="form-check-input" value="1"> <!-- Checkbox input with value 1 -->
        </div>

        <div class="form-group">
            <label for="notes">notes:</label>
            <input type="text" name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror"
                value="{{ old('notes') }}">
            @error('notes')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
