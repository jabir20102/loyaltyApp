@extends('layouts.app')

@section('content')
    <h1>Add Customer</h1>

    <form action="{{ route('customers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="surname">Surname:</label>
            <input type="text" name="surname" id="surname" class="form-control @error('surname') is-invalid @enderror"
                value="{{ old('surname') }}">
            @error('surname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="customer_code">Customer code:</label>
            <input type="number" name="customer_code" id="customer_code" class="form-control @error('customer_code') is-invalid @enderror"
                value="{{ old('customer_code') }}">
            @error('customer_code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" class="form-control @error('gender') is-invalid @enderror" value="{{ old('gender') }}">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
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
                value="{{ old('email') }}">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="tel1">Tel 1 :</label>
            <input type="text" name="tel1" id="tel1" class="form-control @error('tel1') is-invalid @enderror"
                value="{{ old('tel1') }}">
            @error('tel1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="tel2">Tel 2 :</label>
            <input type="text" name="tel2" id="tel2" class="form-control @error('tel2') is-invalid @enderror"
                value="{{ old('tel2') }}">
            @error('tel2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                value="{{ old('address') }}">
            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        

        <div class="form-group">
            <label for="birthdate">Birthdate:</label>
            <input type="date" name="birthdate" id="birthdate"
                class="form-control @error('birthdate') is-invalid @enderror" value="{{ old('birthdate') }}">
            @error('birthdate')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
