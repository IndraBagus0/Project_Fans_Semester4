<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function getCustomersWithProduct()
    {
        $customers = Customer::join('product', 'costumer.id_product', '=', 'product.id')
            ->select('costumer.*', 'product.name_product', 'product.speed', 'product.price', 'product.bandwith')
            ->where('costumer.status', 'non active')
            ->get();

        return response()->json($customers);
    }
    
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = DB::table('users')
            ->where('email', $email)
            ->where('password', $password)
            ->first();

        if ($user) {
            $response = array(
                'success' => true,
                'message' => 'Logged in successfully',
                'email' => $user->email,
                'name' => $user->name,
                'id' => $user->id,
                'address' => $user->address,
            );
            return response()->json($response);
        } else {
            $response = array(
                'success' => false,
                'message' => 'User not found',
            );
            return response()->json($response);
        }
    }

    public function transaction()
    {
        $date_transaction = request()->input('date_transaction');
        $total = request()->input('total');
        $users = request()->input('users');
        $id_costumer = request()->input('id_costumer');

        DB::table('transaction')->insert([
            'date_transaction' => $date_transaction,
            'total' => $total,
            'users' => $users,
            'id_costumer' => $id_costumer
        ]);

        echo "Data Inserted";
    }

    public function updateTransaction()
    {
        $id = request()->input('id');

        DB::table('costumer')->where('id', $id)->update(['status' => 'active']);

        echo "Data Updated";
    }
}
