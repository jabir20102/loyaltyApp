<?php
   
namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
   
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::get();

            return DataTables::of($data)
            ->addColumn('actions', function ($sample) {
                $deleteUrl = route('users.destroy', $sample->id);

               $deleteButton = '<form action="' . $deleteUrl . '" method="POST" style="display: inline-block;">' .
                    csrf_field() .
                    method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')"><i class="fas fa-trash-alt"></i></button>' .
                    '</form>';

                return  $deleteButton;
            })
            ->rawColumns(['actions'])
            ->make(true);
        }
          
        return view('users.index');
    }
    public function create()
    {
         return view('users.create');
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User added successfully.');
    }
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}