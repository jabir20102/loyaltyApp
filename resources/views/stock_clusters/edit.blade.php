@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Customer Group</h1>

        <form action="{{ route('stock-clusters.update', $stockCluster->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="cluster_name">Cluster Name</label>
                <input type="text" name="cluster_name" id="cluster_name" class="form-control" value="{{ $stockCluster->cluster_name }}" required>
            </div>

            <div class="form-group">
                <label for="created_by">Created By</label>
                <input type="text" name="created_by" id="created_by" class="form-control" value="{{ $stockCluster->created_by }}" >
            </div>

            <div class="form-group">
                <label for="isActive">Is Active</label>
                <input type="hidden" name="isActive" value="0"> <!-- Hidden input with value 0 -->
                <input type="checkbox" name="isActive" id="isActive" class="form-check-input" value="1" {{ $stockCluster->isActive ? 'checked' : '' }}> <!-- Checkbox input with value 1 -->
            </div>

            

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('stock-clusters.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection