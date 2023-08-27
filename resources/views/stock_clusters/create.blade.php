@extends('layouts.app')

@section('content')
    <h1>Add Stock Cluster</h1>

    <form action="{{ route('stock-clusters.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="cluster_name">Cluster Name:</label>
            <input type="text" name="cluster_name" id="cluster_name"
                class="form-control @error('cluster_name') is-invalid @enderror" value="{{ old('cluster_name') }}">
            @error('cluster_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="created_by">Created By:</label>
            <input type="text" name="created_by" id="created_by"
                class="form-control @error('created_by') is-invalid @enderror" value="{{ Auth::user()->name }}">
            @error('created_by')
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

       


        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
