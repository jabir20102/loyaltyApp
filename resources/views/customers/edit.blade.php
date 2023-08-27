@extends('layouts.app')

@section('content')
    <h1>Edit Customer</h1>

    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $customer->name }}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="surname">Surname:</label>
            <input type="text" name="surname" id="surname" class="form-control @error('surname') is-invalid @enderror" value="{{ $customer->surname }}" >
            @error('surname')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
        </div>

        <div class="form-group">
            <label for="customer_code">Customer code:</label>
            <input type="number" name="customer_code" id="customer_code" class="form-control @error('customer_code') is-invalid @enderror"
            value="{{ $customer->customer_code }}">
            @error('customer_code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" class="form-control @error('gender') is-invalid @enderror">
                <option value="male" {{ $customer->gender === 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $customer->gender === 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ $customer->gender === 'other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('gender')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
            value="{{ $customer->email }}">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="tel1">Tel 1:</label>
            <input type="text" name="tel1" id="tel1" class="form-control @error('tel1') is-invalid @enderror" value="{{ $customer->tel1 }}" >
            @error('tel1')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
        </div>

        <div class="form-group">
            <label for="tel2">Tel 2:</label>
            <input type="text" name="tel2" id="tel2" class="form-control @error('tel2') is-invalid @enderror" value="{{ $customer->tel2 }}" >
            @error('tel2')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ $customer->address }}" >
            @error('address')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
        </div>

        <div class="form-group">
            <label for="birthdate">Birthdate:</label>
            <input type="date" name="birthdate" id="birthdate" class="form-control @error('birthdate') is-invalid @enderror" value="{{ $customer->birthdate }}"" >
            @error('birthdate')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
        