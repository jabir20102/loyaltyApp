<?php

namespace App\Http\Controllers;

use App\Models\Purchased_items;
use Illuminate\Http\Request;

class PurchasedItemsController extends Controller
{
    public function index()
    {
        return Purchased_items::all();
    }

    public function show($id)
    {
        return Purchased_items::findOrFail($id);
    }

    public function store(Request $request)
    {
        return Purchased_items::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $item = Purchased_items::findOrFail($id);
        $item->update($request->all());
        return $item;
    }

    public function destroy($id)
    {
        $item = Purchased_items::findOrFail($id);
        $item->delete();
        return ['message' => 'Purchased item deleted successfully.'];
    }
}
