<?php

namespace App\Http\Controllers;

use App\Models\excluded_group;
use App\Models\excluded_subgroup;
use App\Models\included_group;
use App\Models\included_subgroup;
use App\Models\stock_cluster_members;
use App\Models\StockCluster;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Psy\Readline\Hoa\ConsoleOutput;

class StockClusterController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $customerGroups = StockCluster::all();


            return DataTables::of($customerGroups)
                ->addColumn('action', function ($customerGroup) {
                    $membersButton = '<a href="' . route('stock-clusters.members', $customerGroup->id) . '" class="btn btn-primary btn-sm"><i class="fa fa-users"></i></a>';
                    $editButton = '<a href="' . route('stock-clusters.edit', $customerGroup->id) . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                    $deleteButton = '<a href="' . route('stock-clusters.destroy', $customerGroup->id) . '" class="btn btn-danger btn-sm" onclick="event.preventDefault(); if(confirm(\'Are you sure you want to delete this cluster?\')) { document.getElementById(\'delete-form-' . $customerGroup->id . '\').submit(); }"><i class="fas fa-trash"></i></a>';
                    $deleteForm = '<form id="delete-form-' . $customerGroup->id . '" action="' . route('stock-clusters.destroy', $customerGroup->id) . '" method="POST" style="display: none;">' . csrf_field() . '<input type="hidden" name="_method" value="DELETE"></form>';

                    return $membersButton . ' ' . $editButton . ' ' . $deleteButton . ' ' . $deleteForm;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('stock_clusters.index');
    }

    public function create()
    {
        return view('stock_clusters.create');
    }
    public function members($cluster_id)
    {
        // $cluster_name=StockCluster::where('id',$cluster_id)->first()->cluster_name;

        $includedGroupes = included_group::where('cluster_id',$cluster_id)->get();
        $includedSubGroupes = included_subgroup::where('cluster_id',$cluster_id)->get();
        $excludedGroupes = excluded_group::where('cluster_id',$cluster_id)->get();
        $excludedSubGroupes = excluded_subgroup::where('cluster_id',$cluster_id)->get();


        return view('stock_clusters.members', compact('cluster_id','includedGroupes','includedSubGroupes','excludedGroupes','excludedSubGroupes'));
    }

    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'cluster_name' => 'required',
            'isActive' => 'required',
            'created_by' => 'nullable',
        ]);

        StockCluster::create($request->all());

        return redirect()->route('stock-clusters.index')
            ->with('success', 'Stock Cluster created successfully.');
    }

    public function edit(StockCluster $stockCluster)
    {
        // return $customerGroup;
        return view('stock_clusters.edit', compact('stockCluster'));
    }

    public function update(Request $request, StockCluster $stockCluster)
    {
        $request->validate([
            'cluster_name' => 'required',
            'isActive' => 'required',
            'created_by' => 'nullable',
        ]);

        $stockCluster->update($request->all());

        return redirect()->route('stock-clusters.index')
            ->with('success', 'Stock Cluster updated successfully.');
    }

    public function destroy(StockCluster $stockCluster)
    {
        $stockCluster->delete();

        return redirect()->route('stock-clusters.index')
            ->with('success', 'Cluster deleted successfully.');
    }



    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');
        $stock_cluster_id = $request->get('stock_cluster_id');
        $created_by = 0;//Auth::user()->id;

        // Load the Excel file using Spout
        $reader = ReaderEntityFactory::createXLSXReader();
        $reader->open($file->getPathname());

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $row) {
                // Assuming customer ID is in the first column
                $stock_code = $row->getCellAtIndex(0)->getValue();
                //  $stock_code = $row->getCellAtIndex(1)->getValue();


                // Save the customer ID to the database
                stock_cluster_members::create([
                    'stock_code' => $stock_code,
                    'is_included' => 0,
                    'stock_cluster_id' => $stock_cluster_id
                ]);
            }
        }

        $reader->close();

        return redirect()->back()->with('success', 'Stock codes uploaded successfully.');
    }

  

    
}
