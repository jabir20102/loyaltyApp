<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductGroup;
use App\Models\ProductSubGroup;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::get();


            return DataTables::of($data)
                // ->addColumn('total_points', function ($sample) {
                //     return ''; // Initial empty value for total points
                // })
                // ->addColumn('used_points', function ($sample) {
                //     return ''; // Initial empty value for used points
                // })
                // ->addColumn('remaining_points', function ($sample) {
                //     return ''; // Initial empty value for remaining points
                // })

                ->addColumn('actions', function ($sample) {
                    $editUrl = route('products.edit', $sample->id);
                    $deleteUrl = route('products.destroy', $sample->id);

                    $editButton = '<a href="' . $editUrl . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                    $deleteButton = '<form action="' . $deleteUrl . '" method="POST" style="display: inline-block;">' .
                        csrf_field() .
                        method_field('DELETE') .
                        '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')"><i class="fas fa-trash-alt"></i></button>' .
                        '</form>';

                    return $editButton . '  ' . $deleteButton;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('products.index');
    }

    public function create()
    {

        $types = Type::all();
        $categories = Category::all();
        $groups = ProductGroup::all();
        $subgroups = ProductSubGroup::all();
        return view('products.create', compact('types', 'categories', 'groups', 'subgroups'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'code' => 'required',
            'type_id' => 'required',
            'special_code1' => 'required',
            'category_id' => 'required',
            'product_group_id' => 'required',
        ];


        $this->validate($request, $rules);

        Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success', 'product added successfully.');
    }

    public function edit($customer_id)
    {
        $types = Type::all();
        $categories = Category::all();
        $groups = ProductGroup::all();
        $subgroups = ProductSubGroup::all();
        $product = Product::find($customer_id);
        return view('products.edit', compact('product', 'types', 'categories', 'groups', 'subgroups'));
    }

    public function update(Request $request, Product $product)
    {

        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'type_id' => 'required',
            'special_code1' => 'required',
            'category_id' => 'required',
            'product_group_id' => 'required',
        ]);


        $product->update($request->all());


        return redirect()->route('products.index')
            ->with('success', 'product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // return $product;
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $customers = Customer::where('name', 'like', '%' . $search . '%')
            ->orWhere('surname', 'like', '%' . $search . '%')
            ->orWhere('tel', 'like', '%' . $search . '%')
            ->orWhere('address', 'like', '%' . $search . '%')
            ->orWhere('birthdate', 'like', '%' . $search . '%')
            ->get();

        return view('products.index', compact('customers'));
    }


    public function exportProducts()
    {
        $fileName = 'products.xlsx';
        $filePath = storage_path('app/' . $fileName);

        $writer = WriterEntityFactory::createXLSXWriter();
        $writer->openToFile($filePath);

        // Bold formatting for the first row
    $boldStyle = (new StyleBuilder())->setFontBold()->build();
        // Write the header row
        $headerRow = WriterEntityFactory::createRowFromArray([
            'Id', 'Product Code', 'Name', 'Name 1', 'Name 2',
            'Name 3', 'Type', 'Special code1', 'Special code2', 'Special code3', 'Category',
            'Product group', 'Product subgroup','Created at'
            
        ]);
        foreach ($headerRow->getCells() as $cell) {
            $cell->setStyle($boldStyle);
        }
        $writer->addRow($headerRow);

        // Fetch and write data rows
        $products = Product::get();

        foreach ($products as $product) {
            $dataRow = WriterEntityFactory::createRowFromArray([
                $product->id, $product->code,
                $product->name, $product->name1, $product->name2, $product->name3, $product->type_id,
                $product->special_code1, $product->special_code2, $product->special_code3,
                $product->category_id, $product->product_group_id, $product->product_subgroup_id
                ,$product->created_at->format('d-m-Y'),
            ]);
            $writer->addRow($dataRow);
        }

        $writer->close();

        return Response::download($filePath, $fileName)->deleteFileAfterSend();
    }
}
