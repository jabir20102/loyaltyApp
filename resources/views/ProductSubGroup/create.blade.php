@extends('layouts.app')

@section('content')
    <h1>Add Product Sub Group</h1>
    <form action="{{ route('productSubGroup.store') }}" method="POST">

        @csrf

        <div class="form-group">
            <label for="product_group_id">Select Group</label>
            <select name="product_group_id" id="product_group_id"
                class="form-control @error('product_group_id') is-invalid @enderror" value="{{ old('product_group_id') }}">
                <option value="">Select a Group</option>
                @foreach ($productGroupes as $group)
                    <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                @endforeach
            </select>
            @error('product_group_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="sub_group_name">Sub Product Group Name</label>
            <input type="text" name="sub_group_name" id="sub_group_name"
                class="form-control @error('sub_group_name') is-invalid @enderror" value="{{ old('sub_group_name') }}"
                required>
            @error('sub_group_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create</button>


    </form>
@endsection
