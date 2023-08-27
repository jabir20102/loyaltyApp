<?php

namespace App\Http\Controllers;

use App\Models\excluded_group;
use App\Models\excluded_subgroup;
use App\Models\included_group;
use App\Models\included_subgroup;
use App\Models\stock_cluster_members;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClusterMembers extends Controller
{
    public function index(Request $request,$id)
    {
      
        if ($request->ajax()) {
            $clusterMember = stock_cluster_members::with('stockCluster')->where('stock_cluster_id',$id)->get();


            return DataTables::of($clusterMember)
            ->addColumn('stock_cluster_name', function ($clusterMember) {
                return $clusterMember->stockCluster->cluster_name;
            })
            ->make(true);
        }

        return view('stock_clusters.index');
    }

    public function createIncludedGroup($cluster_id)
    {
        return view('stock_clusters.includedGroup_create',compact('cluster_id'));
    }
    public function storeIncludedGroup(Request $request)
    {
        $request->validate([
            'group_name' => 'required',
        ]);

        included_group::create($request->all());

        return redirect()->route('stock-clusters.members',$request->input('cluster_id'))
            ->with('success', 'Group added successfully.');
    }
    public function destroyIncludedGroup(included_group $included_group)
    {
        $included_group->delete();
        return redirect()->route('stock-clusters.members',$included_group->cluster_id)
            ->with('success', 'Group deleted successfully.');
    }
    //  for included  sub groups
    public function createIncludedSubGroup($cluster_id)
    {
        return view('stock_clusters.includedSubGroup_create',compact('cluster_id'));
    }
    public function storeIncludedSubGroup(Request $request)
    {
        $request->validate([
            'subgroup_name' => 'required',
            'cluster_id'    => 'required'

        ]);

        included_subgroup::create($request->all());

        return redirect()->route('stock-clusters.members',$request->input('cluster_id'))
            ->with('success', 'Sub Group added successfully.');
    }
    public function destroyIncludedSubGroup(included_subgroup $included_subgroup)
    {
        $included_subgroup->delete();
        return redirect()->route('stock-clusters.members',$included_subgroup->cluster_id)
            ->with('success', 'Group deleted successfully.');
    }
    //  for exluded group
    public function createExcludedGroup($cluster_id)
    {
        return view('stock_clusters.excludedGroup_create',compact('cluster_id'));
    }
    public function storeExcludedGroup(Request $request)
    {
        $request->validate([
            'group_name' => 'required',
        ]);

        excluded_group::create($request->all());

        return redirect()->route('stock-clusters.members',$request->input('cluster_id'))
            ->with('success', 'Group added successfully.');
    }
    public function destroyExcludedGroup(excluded_group $excluded_group)
    {
        $excluded_group->delete();
        return redirect()->route('stock-clusters.members',$excluded_group->cluster_id)
            ->with('success', 'Group deleted successfully.');
    }
    //  for excluded  sub groups
    public function createExcludedSubGroup($cluster_id)
    {
        return view('stock_clusters.excludedSubGroup_create',compact('cluster_id'));
    }
    public function storeExcludedSubGroup(Request $request)
    {
        $request->validate([
            'subgroup_name' => 'required',
        ]);

        excluded_subgroup::create($request->all());

        return redirect()->route('stock-clusters.members',$request->input('cluster_id'))
            ->with('success', 'Sub Group added successfully.');
    }
    public function destroyExcludedSubGroup(excluded_subgroup $excluded_subgroup)
    {
        $excluded_subgroup->delete();
        return redirect()->route('stock-clusters.members',$excluded_subgroup->cluster_id)
            ->with('success', 'Group deleted successfully.');
    }
}
