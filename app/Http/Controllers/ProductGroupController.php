<?php

namespace App\Http\Controllers;

use App\Models\ProductGroup;
use Illuminate\Http\Request;

class ProductGroupController extends Controller
{
    public function index()
    {
        $productGroupes = ProductGroup::get();
        return view('ProductGroup.index', compact('productGroupes'));
    }
    public function create()
    {
        return view('ProductGroup.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'group_name' => 'required|unique:product_groups',
        ];

        $this->validate($request, $rules);

        ProductGroup::create($request->all());

        return redirect()->route('productGroup.index')
            ->with('success', 'productGroupe added successfully.');
        // You can add additional logic here (e.g., redirect, return JSON response, etc.)
    }
    public function edit(ProductGroup $productGroup)
    {
        return view('ProductGroup.edit', compact('productGroup'));
    }

    public function update(Request $request, ProductGroup $productGroup)
    {
        $validatedData = $request->validate([
            
            'group_name' => 'required|unique:product_groups',
        ]);

        $productGroup->update($validatedData);
        return redirect()->route('productGroup.index')->with('success', 'group updated successfully.');
    }

    public function destroy(ProductGroup $productGroup)
    {
        $productGroup->delete();
        return redirect()->route('productGroup.index')->with('success', 'product group  deleted successfully.');
    }
}

