<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\customer_group_definition_cardno;
use App\Models\customer_group_definition_personality;
use App\Models\CustomerGroup;
use App\Models\CustomerGroupMember;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Psy\Readline\Hoa\ConsoleOutput;

class CustomerGroupController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $customerGroups = CustomerGroup::all();


            return DataTables::of($customerGroups)
                ->addColumn('action', function ($customerGroup) {
                    $membersButton = '<a href="' . route('customer-groups.members', $customerGroup->id) . '" class="btn btn-primary btn-sm"><i class="fa fa-users"></i></a>';
                    $editButton = '<a href="' . route('customer-groups.edit', $customerGroup->id) . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                    $deleteButton = '<a href="' . route('customer-groups.destroy', $customerGroup->id) . '" class="btn btn-danger btn-sm" onclick="event.preventDefault(); if(confirm(\'Are you sure you want to delete this customer group?\')) { document.getElementById(\'delete-form-' . $customerGroup->id . '\').submit(); }"><i class="fas fa-trash"></i></a>';
                    $deleteForm = '<form id="delete-form-' . $customerGroup->id . '" action="' . route('customer-groups.destroy', $customerGroup->id) . '" method="POST" style="display: none;">' . csrf_field() . '<input type="hidden" name="_method" value="DELETE"></form>';

                    return $membersButton . ' ' . $editButton . ' ' . $deleteButton . ' ' . $deleteForm;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('customer_groups.index');
    }

    public function create()
    {
        return view('customer_groups.create');
    }
    public function members($group_id)
    {

        return view('customer_groups.members', compact('group_id'));
    }

    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'group_name' => 'required',
            'isActive' => 'required',
            'notes' => 'nullable',
        ]);

        CustomerGroup::create($request->all());

        return redirect()->route('customer-groups.index')
            ->with('success', 'Customer group created successfully.');
    }

    public function edit(CustomerGroup $customerGroup)
    {
        // return $customerGroup;
        return view('customer_groups.edit', compact('customerGroup'));
    }

    public function update(Request $request, CustomerGroup $customerGroup)
    {
        $request->validate([
            'group_name' => 'required',
            'isActive' => 'required',
            'notes' => 'nullable',
        ]);

        $customerGroup->update($request->all());

        return redirect()->route('customer-groups.index')
            ->with('success', 'Customer group updated successfully.');
    }

    public function destroy(CustomerGroup $customerGroup)
    {
        $customerGroup->delete();

        return redirect()->route('customer-groups.index')
            ->with('success', 'Customer group deleted successfully.');
    }



    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');
        $customer_group_id = $request->get('customer_group_id');
        $created_by = Auth::user()->id;

        // Load the Excel file using Spout
        $reader = ReaderEntityFactory::createXLSXReader();
        $reader->open($file->getPathname());

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $row) {
                // Assuming customer ID is in the first column
                $customerId = $row->getCellAtIndex(0)->getValue();
                 $customerCode = $row->getCellAtIndex(1)->getValue();


                // Save the customer ID to the database
                CustomerGroupMember::create([
                    'customer_id' => $customerId,
                    'customer_code' => $customerCode,
                    'customer_group_id' => $customer_group_id,
                    'created_by' =>  $created_by,
                    'source'     => 'excel_upload',
                ]);
            }
        }

        $reader->close();

        return redirect()->back()->with('success', 'Customer IDs uploaded successfully.');
    }

    public function personality(Request $request)
    {

        $request->validate([
            'birth_year' => 'required',
        ]);

        $data = $request->all();
        $data['created_by'] = Auth::user()->id;

        customer_group_definition_personality::create($data);

        return redirect()->route('customer-groups.index')
            ->with('success', 'Customer group members updated successfully.');
    }
    public function cardno(Request $request)
    {

        $request->validate([
            'card_no_start' => 'required',
            'card_no_end' => 'required',
        ]);

        $data = $request->all();
        $data['created_by'] = Auth::user()->id;

        customer_group_definition_cardno::create($data);

        return redirect()->route('customer-groups.index')
            ->with('success', 'Customer group members updated successfully.');
    }

    public function group_members(Request $request, $group_id)
    {
        if ($request->ajax()) {
            $customerGroupMembers = CustomerGroupMember::with('customer', 'customer_group', 'user')->where('customer_group_id', '=', $group_id)->get();

            return DataTables::of($customerGroupMembers)

                // ->addColumn('group_name', function ($customerGroupMember) {
                //     return $customerGroupMember->customer_group->group_name;
                // })
                ->addColumn('customer_name', function ($customerGroupMember) {
                    $customer=  $customerGroupMember->customer;

                    if($customer!=null){
                        return $customerGroupMember->customer->name;;
                    }else{
                        return "Not found";
                    }
                })
                ->addColumn('customer_code', function ($customerGroupMember) {
                    $customer=  $customerGroupMember->customer;

                    if($customer!=null){
                        return $customerGroupMember->customer->customer_code;;
                    }else{
                        return "Not found";
                    }
                })
                ->addColumn('customer_gender', function ($customerGroupMember) {
                    $customer=  $customerGroupMember->customer;
                    if($customer!=null){
                        return $customerGroupMember->customer->gender;;
                    }else{
                        return "Not found";
                    }
                })
                ->addColumn('customer_code', function ($customerGroupMember) {
                    $customer=  $customerGroupMember->customer;
                    if($customer!=null){
                        return $customerGroupMember->customer->customer_code;;
                    }else{
                        return "Not found";
                    }
                })
                ->addColumn('customer_tel1', function ($customerGroupMember) {
                    $customer=  $customerGroupMember->customer;
                    if($customer!=null){
                        return $customerGroupMember->customer->tel1;;
                    }else{
                        return "Not found";
                    }
                })
                ->addColumn('customer_email', function ($customerGroupMember) {
                    $customer=  $customerGroupMember->customer;
                    if($customer!=null){
                        return $customerGroupMember->customer->email;;
                    }else{
                        return "Not found";
                    }
                })
                ->addColumn('customer_address', function ($customerGroupMember) {
                    $customer=  $customerGroupMember->customer;
                    if($customer!=null){
                        return $customerGroupMember->customer->address;;
                    }else{
                        return "Not found";
                    }
                })
                ->addColumn('user', function ($customerGroupMember) {
                    $user= $customerGroupMember->user;
                    if($user!=null){
                        return $customerGroupMember->user->name;
                    }else{
                        return "Admin";
                    }
                })
                ->make(true);
        }

        return view('customer_groups.members', compact('group_id'));
    }
}
