@extends('layouts.app')

@section('content')
    <h1>Update Product Sub Group</h1>
    
    <form action="{{ route('productSubGroup.update',$productSubGroup->id) }}" method="POST">
            
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="product_group_id">Select Group</label>
            <select name="product_group_id" id="product_group_id"  class="form-control @error('product_group_id') is-invalid @enderror">
                <option value="">Select a Group</option>
                @foreach($productGroupes as $group)
                    <option value="{{ $group->id }}" @if($group->id == $productSubGroup->product_group_id) selected @endif>{{ $group->group_name }}</option>
                @endforeach
            </select>
            @error('product_group_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
            <div class="form-group">
                <label for="sub_group_name">Product Sub Group Name</label>
                <input type="text" name="sub_group_name" id="sub_group_name" class="form-control @error('sub_group_name') is-invalid @enderror" value="{{ $productSubGroup->sub_group_name }}" required>
                @error('sub_group_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
                
    <button type="submit" class="btn btn-primary mt-3">Update</button>
            
    
</form>
@endsection
