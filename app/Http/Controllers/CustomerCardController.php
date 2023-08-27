<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerCard;
use Illuminate\Http\Request;

class CustomerCardController extends Controller
{
    public function index($id)
    {
        
        $customerCards = CustomerCard::where('customer_id',$id)->get();
        $customer = Customer::select('id','customer_code', 'name', 'tel1', 'tel2')
                    ->find($id);
        return view('customer-cards.index', compact('customerCards','customer'));
    }

    public function create($id)
    {
        return view('customer-cards.create', compact('id'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'cc_card_no' => 'required|unique:customer_cards',
            'cc_isValid' => 'boolean',
            'cc_validFrom' => 'nullable|date',
            'cc_validTo' => 'nullable|date',
            'cc_total_earn' => 'nullable|numeric',
            'cc_total_spent' => 'nullable|numeric',
            'cc_type' => 'nullable|string|max:45',
            'cc_status' => 'nullable|string|max:45',
        ]);

        $customerCard=CustomerCard::create($validatedData);
        $id=$customerCard->customer_id;
        return redirect()->route('customer.cards.index',$id)->with('success', 'Customer card created successfully.');
    }

    public function show(CustomerCard $customerCard)
    {
        return view('customer-cards.show', compact('customerCard'));
    }

    public function edit(CustomerCard $customerCard)
    {
        return view('customer-cards.edit', compact('customerCard'));
    }

    public function update(Request $request, CustomerCard $customerCard)
    {
        $validatedData = $request->validate([
            'cc_card_no' => 'required|unique:customer_cards,cc_card_no,' . $customerCard->id,
            'cc_isValid' => 'boolean',
            'cc_validFrom' => 'nullable|date',
            'cc_validTo' => 'nullable|date',
            'cc_total_earn' => 'nullable|numeric',
            'cc_total_spent' => 'nullable|numeric',
            'cc_type' => 'nullable|string|max:45',
            'cc_status' => 'nullable|string|max:45',
            'cc_createdate' => 'nullable|date',
            'cc_update' => 'nullable|date',
        ]);

        $customerCard->update($validatedData);
        return redirect()->route('customer.cards.index',$customerCard->customer_id)->with('success', 'Customer card updated successfully.');
    }

    public function destroy(CustomerCard $customerCard)
    {
        $id=$customerCard->customer_id;
        $customerCard->delete();
        return redirect()->route('customer.cards.index',$id)->with('success', 'Customer card deleted successfully.');
    }
}
