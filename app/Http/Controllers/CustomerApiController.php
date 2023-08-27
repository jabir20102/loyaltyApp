<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerApiController extends Controller
{
    public function index()
    {
        $customers = Customer::all();

        return response()->json($customers);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:customers',
            'tel1' => 'required|numeric',
            'tel2' => 'nullable|numeric',
            'address' => 'required',
            'birthdate' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $customer = Customer::create($request->all());

        return response()->json(['customer'=> $customer, 'message' => 'Customer created successfully.'], 201);
    }

    public function read($customerId)
    {
        $customer = Customer::find($customerId);

        if (!$customer) {
            return response()->json(['error' => 'Customer not found.'], 404);
        }

        return response()->json($customer);
    }

    public function update(Request $request, $customerId)
    {
        $customer = Customer::find($customerId);

        if (!$customer) {
            return response()->json(['error' => 'Customer not found.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:customers,email,' . $customerId,
            'tel1' => 'required|numeric',
            'tel2' => 'nullable|numeric',
            'address' => 'required',
            'birthdate' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $customer->update($request->all());

        return response()->json(['customer'=> $customer, 'message' => 'Customer updated successfully.']);
    }

    public function delete($customerId)
    {
        $customer = Customer::find($customerId);

        if (!$customer) {
            return response()->json(['error' => 'Customer not found.'], 404);
        }

        $customer->delete();

        return response()->json(['id' => $customerId, 'message' => 'Customer deleted successfully.']);
    }
}

