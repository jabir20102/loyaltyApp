@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Customer Group</h1>

        <form action="{{ route('customer-groups.update', $customerGroup->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="group_name">Group Name</label>
                <input type="text" name="group_name" id="group_name" class="form-control" value="{{ $customerGroup->group_name }}" required>
            </div>

            <div class="form-group">
                <label for="isActive">Is Active</label>
                <input type="hidden" name="isActive" value="0"> <!-- Hidden input with value 0 -->
                <input type="checkbox" name="isActive" id="isActive" class="form-check-input" value="1" {{ $customerGroup->isActive ? 'checked' : '' }}> <!-- Checkbox input with value 1 -->
            </div>

            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea name="notes" id="notes" class="form-control">{{ $customerGroup->notes }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('customer-groups.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection