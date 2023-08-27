@extends('layouts.app')

@section('content')
    <p><strong>Customer Name:</strong> {{ $customer->name }}</p>
    <p><strong>Customer Code:</strong> {{ $customer->customer_code }}</p>
    <p><strong>Customer Phone No:</strong> {{ $customer->tel1 }}</p>
    <p><strong>Customer Phone No 2:</strong> {{ $customer->tel2 }}</p>
    <a href="{{ route('customer.cards.create',$customer->id) }}" class="btn btn-primary mb-3">Add New Card</a>
    <h1>Customer Card Details</h1>
    
    <div class="table-responsive">
    <table class="table table-striped table-bordered">
        
        <thead>
            <tr>
                <th>Card No</th>
                <th>Is Valid</th>
                <th>Total Earn</th>
                <th>Total Spent</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customerCards as $customerCard)
                <tr>
                    <td>{{ $customerCard->cc_card_no }}</td>
                    <td>{{ $customerCard->cc_isValid ? 'Yes' : 'No' }}</td>
                    <td>{{ $customerCard->cc_total_earn }}</td>
                    <td>{{ $customerCard->cc_total_spent }}</td>
                    <td>
                        <a href="{{ route('customer.cards.show', $customerCard->id) }}" class="btn btn-info btn-sm" title="View"> 
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('customer.cards.edit', $customerCard->id) }}" class="btn btn-primary btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('customer.cards.destroy', $customerCard->id) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this card?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
