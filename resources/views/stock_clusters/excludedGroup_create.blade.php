@extends('layouts.app')

@section('content')
<a href="{{ url()->previous() }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> 
</a>
   
<h1>Add excluded Group</h1>
    <form action="{{ route('excludedGroup.store') }}" method="POST">

        @csrf
        <div class="form-group">
            <label for="created_by">Created by </label>
            <input type="text" name="created_by" id="created_by"
                class="form-control @error('created_by') is-invalid @enderror" value="{{ Auth::user()->name }}" required>
            @error('created_by')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
       

    
        <div class="form-group">
            <label for="group_name">Group Name</label>
            <select id="group_name" name="group_name" class="form-control">
                @php
                    $productGroups = \App\Models\ProductGroup::all();
                @endphp
    
                @foreach($productGroups as $productGroup)
                    <option value="{{ $productGroup->group_name }}">{{ $productGroup->group_name }}</option>
                @endforeach
            </select>
        </div>
        
        <input type="hidden" name="cluster_id" value="{{$cluster_id}}">

        <button type="submit" class="btn btn-primary mt-3">Create</button>


    </form>
@endsection
