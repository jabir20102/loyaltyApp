<?php

namespace App\Http\Controllers;

use App\Models\Purchases;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PurchasesController extends Controller
{
    public function index()
    {
        // return Purchases::all();
        return Purchases::with('purchased_item')->get();
    }

    public function show($id)
    {
        return Purchases::with('purchased_item')->findOrFail($id);
    }

    public function store(Request $request)
    {
        return Purchases::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $purchase = Purchases::findOrFail($id);
        $purchase->update($request->all());
        return $purchase;
    }

    public function destroy($id)
    {
        try {
            $purchase = Purchases::findOrFail($id);
            $purchase->delete();
            return ['message' => 'Purchase deleted successfully.'];
        } catch (QueryException $e) {
            return response()->json(['message' => 'Cannot delete the purchases item. It may have references in other tables.'], 422);
        }
    }
}
