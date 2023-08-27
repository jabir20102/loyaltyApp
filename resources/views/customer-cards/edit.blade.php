@extends('layouts.app')

@section('content')
    <h1>Edit Customer Card</h1>
    <form action="{{ route('customer.cards.update', $customerCard->id) }}" method="POST">
        @csrf
        @method('PUT')
    <div class="row">        
        <div class="col-md-6">
            <!-- First Column -->
            <div class="form-group">
                <label for="cc_card_no">Card No</label>
                <input type="text" name="cc_card_no" id="cc_card_no" class="form-control @error('cc_card_no') is-invalid @enderror" value="{{ old('cc_card_no', $customerCard->cc_card_no) }}" required>
                @error('cc_card_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
                <div class="form-group">
                    <label for="cc_isValid">Is Valid?</label>
                    <select name="cc_isValid" id="cc_isValid" class="form-control">
                        <option value="1" {{ $customerCard->cc_isValid ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ !$customerCard->cc_isValid ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cc_validFrom">Valid From</label>
                    <input type="date" name="cc_validFrom" id="cc_validFrom" class="form-control" value="{{ $customerCard->cc_validFrom }}">
                </div>
                <div class="form-group">
                    <label for="cc_validTo">Valid To</label>
                    <input type="date" name="cc_validTo" id="cc_validTo" class="form-control" value="{{ $customerCard->cc_validTo }}">
                </div>
                <!-- Add more fields for the first column here -->
            
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="cc_total_earn">Total Earn</label>
                <input type="number" name="cc_total_earn" id="cc_total_earn" class="form-control @error('cc_total_earn') is-invalid @enderror" value="{{ $customerCard->cc_total_earn }}">
                @error('cc_total_earn')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <div class="form-group">
                <label for="cc_total_spent">Total Spent</label>
                <input type="number" name="cc_total_spent" id="cc_total_spent" class="form-control @error('cc_card_spent') is-invalid @enderror" value="{{ $customerCard->cc_total_spent }}">
                @error('cc_total_spent')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <div class="form-group">
                <label for="cc_type">Card Type</label>
                <input type="text" name="cc_type" id="cc_type" class="form-control @error('cc_type') is-invalid @enderror" value="{{ $customerCard->cc_type }}">
                @error('cc_type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <div class="form-group">
                <label for="cc_status">Card Status</label>
                <input type="text" name="cc_status" id="cc_status" class="form-control @error('cc_status') is-invalid @enderror" value="{{ $customerCard->cc_status }}">
                @error('cc_status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            
            
        </div>
    
    </div>
    <button type="submit" class="btn btn-primary mt-3">Update</button>
</form>
@endsection

