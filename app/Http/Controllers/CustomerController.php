<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerGroupMember;
use App\Models\Purchased_items;
use App\Models\Purchases;
use Illuminate\Http\Request;
use App\Models\User;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;


class CustomerController extends Controller
{

    private $filteredQuery;

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'customer_code' => 'required|numeric',
            'gender' => 'required',
            'email' => 'required',
            'tel1' => 'required|numeric',
            'tel2' => 'numeric',
            'address' => 'required',
            'birthdate' => 'required|date',
        ]);

        Customer::create($request->all());

        return redirect()->route('customers.index')
            ->with('success', 'Customer added successfully.');
    }

    public function edit($customer_id)
    {
        $customer = Customer::find($customer_id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'customer_code' => 'required|numeric',
            'gender' => 'required',
            'email' => 'required',
            'tel1' => 'required|numeric',
            'tel2' => 'numeric',
            'address' => 'required',
            'birthdate' => 'required|date',
        ]);


        $customer->update($request->all());


        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    public function destroy($customer_id)
    {
        return $customer_id;
        // $customer->delete();

        // return redirect()->route('customers.index')
        //     ->with('success', 'Customer deleted successfully.');
    }

    public function purchases($customer_id)
    {
        $purchases = Purchases::where('customer_code', $customer_id)->get();
        $customer = Customer::select('id', 'customer_code', 'name', 'tel1', 'tel2')
            ->find($customer_id);

        return view('customers.purchases', compact('purchases', 'customer'));
    }

    public function getPurchasedItems($id)
    {
        // Retrieve purchased items data for the given purchase ID
        $purchasedItems = Purchased_items::where('purchases_id', $id)->get();

        // Return the data as JSON response
        return response()->json($purchasedItems);
    }

    public function exportCustomersWithCards(Request $request)
    {
        $fileName = 'customers_with_cards.xlsx'; // Change this to your desired file name
        $filePath = storage_path('app/' . $fileName);

        $writer = WriterEntityFactory::createXLSXWriter();
        $writer->openToFile($filePath);

        // Bold formatting for the first row
        $boldStyle = (new StyleBuilder())->setFontBold()->build();

        // Write the header row
        $headerRow = WriterEntityFactory::createRowFromArray(['Customer Name','Customer Code','Gender',
        'Address','Date of Birth','Tel 1', 'Email', 'Card Number','Card Valid From','Card Valid To']);

        foreach ($headerRow->getCells() as $cell) {
            $cell->setStyle($boldStyle);
        }
        $writer->addRow($headerRow);

        
        $customerIds = request()->input('customer_ids');

        // Convert the JSON-encoded array back to a PHP array
        $customerIdsArray = json_decode($customerIds, true);

        $customers = Customer::with('cards')->whereIn('customers.id', $customerIdsArray)->get();

        foreach ($customers as $customer) {
            $hasFirstCard = true;
            foreach ($customer->cards as $card) {
                $rowData = [
                    $hasFirstCard ? $customer->name : '-',
                    $hasFirstCard ? $customer->customer_code : '-',
                    $hasFirstCard ? $customer->gender : '-',
                    $hasFirstCard ? $customer->address : '-',
                    $hasFirstCard ? $customer->birthdate : '-',
                    $hasFirstCard ? $customer->tel1 : '-',
                    $hasFirstCard ? $customer->email : '-',
                    $card->cc_card_no,
                    $card->cc_validFrom,
                    $card->cc_validTo,
                ];

                $writer->addRow(WriterEntityFactory::createRowFromArray($rowData));
                $hasFirstCard = false;
            }
        }

        $writer->close();
        
       
        //  Response::download($filePath, $fileName)->deleteFileAfterSend();
          // Return a JSON response with success and file URL
        return response()->json([
            'success' => true,
            'file_url' =>  asset('storage/' . $fileName), // Adjust the path if needed
        ]);
    }

    public function index(Request $request)
    {
        
        if ($request->ajax()) {
        $query = Customer::query();

        if ($request->input('cardNumber') != "") {
            $query->whereHas('cards', function ($q) use ($request) {
                $q->where('cc_card_no', $request->input('cardNumber'));
            });
        }
        if ($request->input('cardRangeStart') != "") {
            $query->whereHas('cards', function ($q) use ($request) {
                $q->whereBetween('cc_card_no', [$request->input('cardRangeStart'), $request->input('cardRangeEnd')]);
            });
        }
        //   As we dont have points for customers right now 
        // if ($request->input('totalPointStart')!="") {
        //     $query->whereHas('cards', function ($q) use ($request) {
        //         $q->whereBetween('cc_card_no', [$request->input('totalPointStart'), $request->input('totalPointEnd')]);
        //     });
        // }
        // if ($request->input('cardRangeStart')!="") {
        //     $query->whereHas('cards', function ($q) use ($request) {
        //         $q->whereBetween('cc_card_no', [$request->input('usedPointStart'), $request->input('usedPointEnd')]);
        //     });
        // }
        // if ($request->input('cardRangeStart')!="") {
        //     $query->whereHas('cards', function ($q) use ($request) {
        //         $q->whereBetween('cc_card_no', [$request->input('remainingPointStart'), $request->input('remainingPointEnd')]);
        //     });
        // }



            return DataTables::of($query)
                ->addColumn('total_points', function ($sample) {
                    return ''; // Initial empty value for total points
                })
                ->addColumn('used_points', function ($sample) {
                    return ''; // Initial empty value for used points
                })
                ->addColumn('remaining_points', function ($sample) {
                    return ''; // Initial empty value for remaining points
                })

                ->addColumn('actions', function ($sample) {
                    $customer_cards_url = route('customer.cards.index', $sample->id);
                    $purchasesUrl = route('customers.purchases', $sample->id);
                    $editUrl = route('customers.edit', $sample->id);
                    $deleteUrl = route('customers.destroy', $sample->id);

                    $customer_cards = '<a href="' . $customer_cards_url . '" class="btn btn-primary btn-sm mt-1 title="cards"><i class="fas fa-credit-card"></i></a>';
                    $purchasesButton = '<a href="' . $purchasesUrl . '" class="btn btn-primary btn-sm mt-1" title="purchases"><i class="fa fa-shopping-cart"></i></a>';
                    $editButton = '<a href="' . $editUrl . '" class="btn btn-primary btn-sm mt-1" title="edit"><i class="fas fa-edit"></i></a>';
                    $deleteButton = '<form action="' . $deleteUrl . '" method="POST" style="display: inline-block;">' .
                        csrf_field() .
                        method_field('DELETE') .
                        '<button type="submit" class="btn btn-danger btn-sm mt-1"  onclick="return confirm(\'Are you sure?\')" title="delete"><i class="fas fa-trash-alt"></i></button>' .
                        '</form>';

                    return $customer_cards . ' ' . $purchasesButton . ' ' . $editButton . '  ' . $deleteButton;
                })
                ->rawColumns(['actions'])
                //    ->make(true);
                ->toJson();
        }
        return view('customers.index');
    }
    public function yourControllerMethod(Request $request)
    {       
        
         $fileName = 'customers_with_cards.xlsx'; // Change this to your desired file name
         $filePath = storage_path('app/' . $fileName);
 
         $writer = WriterEntityFactory::createXLSXWriter();
         $writer->openToFile($filePath);
 
         // Bold formatting for the first row
         $boldStyle = (new StyleBuilder())->setFontBold()->build();
 
         // Write the header row
         $headerRow = WriterEntityFactory::createRowFromArray(['Customer Name','Customer Code','Gender',
         'Address','Date of Birth','Tel 1', 'Email', 'Card Number','Card Valid From','Card Valid To']);
 
         foreach ($headerRow->getCells() as $cell) {
             $cell->setStyle($boldStyle);
         }
         $writer->addRow($headerRow);
 
         
         $customerIds = request()->input('customer_ids');

        // Convert the JSON-encoded array back to a PHP array
         $customerIdsArray = json_decode($customerIds, true);
 
         $customers = Customer::with('cards')->whereIn('customers.id', $customerIdsArray)->get();
 
         foreach ($customers as $customer) {
             $hasFirstCard = true;
             foreach ($customer->cards as $card) {
                 $rowData = [
                     $hasFirstCard ? $customer->name : '-',
                     $hasFirstCard ? $customer->customer_code : '-',
                     $hasFirstCard ? $customer->gender : '-',
                     $hasFirstCard ? $customer->address : '-',
                     $hasFirstCard ? $customer->birthdate : '-',
                     $hasFirstCard ? $customer->tel1 : '-',
                     $hasFirstCard ? $customer->email : '-',
                     $card->cc_card_no,
                     $card->cc_validFrom,
                     $card->cc_validTo,
                 ];
 
                 $writer->addRow(WriterEntityFactory::createRowFromArray($rowData));
                 $hasFirstCard = false;
             }
         }
 
         $writer->close();
         
        //    // Return a JSON response with success and file URL
         return response()->json([
             'success' => true,
             'file_url' =>  storage_path('app/' . $fileName), // Adjust the path if needed
         ]);
    }
    public function downloadExcelFile()
{
    $filePath = storage_path('app/customers_with_cards.xlsx');
    $headers = [
        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    ];

    return response()->download($filePath, 'customers_with_cards.xlsx', $headers)->deleteFileAfterSend();
}
}
