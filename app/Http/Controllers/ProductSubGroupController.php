<?php

namespace App\Http\Controllers;

use App\Models\ProductGroup;
use App\Models\ProductSubGroup;
use Illuminate\Http\Request;

class ProductSubGroupController extends Controller
{
    public function index()
    {
        $productSubGroupes = ProductSubGroup::get();
        return view('ProductSubGroup.index', compact('productSubGroupes'));
    }
    public function create()
    {
        
        $productGroupes = ProductGroup::get();
        return view('ProductSubGroup.create', compact('productGroupes'));
    }

    public function store(Request $request)
    {
        //  return $request->all();
        // Validate the incoming request data
        $request->validate([
            'product_group_id' => 'required|exists:product_groups,id',
            'sub_group_name' => 'required|string|max:45',
        ]);

        // Create a new sub group instance and save it in the database
        $subgroup = new ProductSubgroup();
        $subgroup->product_group_id = $request->input('product_group_id'); // Assign the group_id
        $subgroup->sub_group_name = $request->input('sub_group_name');
        $subgroup->save();
        

        return redirect()->route('productSubGroup.index')
            ->with('success', 'Product Sub Groupe added successfully.');
    }
    public function edit(ProductSubGroup $productSubGroup)
    {
        
        $productGroupes = ProductGroup::get();
        return view('ProductSubGroup.edit', compact('productSubGroup','productGroupes'));
    }

    public function update(Request $request, ProductSubGroup $productSubGroup)
    {
        $request->validate([
            'product_group_id' => 'required|exists:product_groups,id',
            'sub_group_name' => 'required|string|max:45',
        ]);

        $productSubGroup->product_group_id = $request->input('product_group_id'); // Assign the group_id
        $productSubGroup->sub_group_name = $request->input('sub_group_name');
        $productSubGroup->update();
        return redirect()->route('productSubGroup.index')->with('success', 'Sub group updated successfully.');
    }

    public function destroy(ProductSubGroup $productSubGroup)
    {
        $productSubGroup->delete();
        return redirect()->route('productSubGroup.index')->with('success', 'Product Sub group  deleted successfully.');
    }
}

