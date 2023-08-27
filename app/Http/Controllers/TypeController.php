<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::get();
        return view('types.index', compact('types'));
    }
    public function create()
    {
        return view('types.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'type_name' => 'required',
        ];

        $this->validate($request, $rules);

        Type::create($request->all());

        return redirect()->route('types.index')
            ->with('success', 'Types added successfully.');
        // You can add additional logic here (e.g., redirect, return JSON response, etc.)
    }
    public function edit(Type $type)
    {
        return view('types.edit', compact('type'));
    }

    public function update(Request $request, Type $type)
    {
        $validatedData = $request->validate([
            
            'type_name' => 'required',
        ]);

        $type->update($validatedData);
        return redirect()->route('types.index')->with('success', 'Type updated successfully.');
    }

    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('types.index')->with('success', 'Type  deleted successfully.');
    }
}

