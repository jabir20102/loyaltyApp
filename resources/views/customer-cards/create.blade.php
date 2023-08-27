@extends('layouts.app')

@section('content')
    <h1>Add New Customer Card</h1>
    <form action="{{ route('customer.cards.store') }}" method="POST">
            
        @csrf
    <div class="row">
       
        <div class="col-md-6">
            <!-- First Column -->
            <input type="hidden" name="customer_id"  value="{{$id }}">
               
            <div class="form-group">
                <label for="cc_card_no">Card No</label>
                <input type="text" name="cc_card_no" id="cc_card_no" class="form-control @error('cc_card_no') is-invalid @enderror" value="{{ old('cc_card_no') }}" required>
                @error('cc_card_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
                <div class="form-group">
                    <label for="cc_isValid">Is Valid?</label>
                    <select name="cc_isValid" id="cc_isValid" class="form-control">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cc_validFrom">Valid From</label>
                    <input type="date" name="cc_validFrom" id="cc_validFrom" class="form-control">
                </div>
                <div class="form-group">
                    <label for="cc_validTo">Valid To</label>
                    <input type="date" name="cc_validTo" id="cc_validTo" class="form-control">
                </div>
        </div>
        <div class="col-md-6">
                <!-- Second Column -->
                
                <div class="form-group">
                    <label for="cc_total_earn">Total Earn</label>
                    <input type="number" name="cc_total_earn" id="cc_total_earn" class="form-control @error('cc_total_earn') is-invalid @enderror" value="{{ old('cc_total_earn') }}" >
                    @error('cc_total_earn')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cc_total_spent">Total Spent</label>
                    <input type="number" name="cc_total_spent" id="cc_total_spent" class="form-control">
                </div>
                <div class="form-group">
                    <label for="cc_type">Card Type</label>
                    <input type="text" name="cc_type" id="cc_type" class="form-control">
                    @error('cc_type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group">
                    <label for="cc_status">Card Status</label>
                    <input type="text" name="cc_status" id="cc_status" class="form-control">
                    @error('cc_status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                
        </div>
        
    </div>
    <button type="submit" class="btn btn-primary mt-3">Create</button>
            
    
</form>
@endsection
