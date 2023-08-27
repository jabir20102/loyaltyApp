<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view('category.index', compact('categories'));
    }
    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'category_name' => 'required',
        ];

        $this->validate($request, $rules);

        Category::create($request->all());

        return redirect()->route('category.index')
            ->with('success', 'category added successfully.');
        // You can add additional logic here (e.g., redirect, return JSON response, etc.)
    }
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            
            'category_name' => 'required',
        ]);

        $category->update($validatedData);
        return redirect()->route('category.index')->with('success', 'category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with('success', 'category  deleted successfully.');
    }
}

