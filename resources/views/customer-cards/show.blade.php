@extends('layouts.app')

@section('content')
    <h1>Customer Card Details</h1>
    <p><strong>Card No:</strong> {{ $customerCard->cc_card_no }}</p>
    <p><strong>Is Valid:</strong> {{ $customerCard->cc_isValid ? 'Yes' : 'No' }}</p>
    <p><strong>Total Earn:</strong> {{ $customerCard->cc_total_earn }}</p>
    <p><strong>Total Spent:</strong> {{ $customerCard->cc_total_spent }}</p>
    <!-- Add other fields as needed -->
    <a href="{{ route('customer.cards.edit', $customerCard->id) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('customer.cards.destroy', $customerCard->id) }}" method="POST" style="display: inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this card?')">Delete</button>
    </form>
@endsection
