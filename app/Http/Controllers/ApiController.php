<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            ->first();

        if ($user && Hash::check($password, $user->password)) {
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
                'message' => 'User not found or incorrect password',
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
    public function register()
    {
        $username = request()->input('username');
        $email = request()->input('email');
        $password = request()->input('password');
        $phone_number = request()->input('phone_number');
        $address = request()->input('address');

        DB::table('costumer')->insert([
            'name' => $username,
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'phone_number' => $phone_number,
            'status' => 'non active',
            'address' => $address,
            'id_product' => 1,
            'subcribe_date' => '2023-05-08',
        ]);

        echo "Data Berhasil di Simpan";
    }

    public function Produk()
    {
        $products = Produk::all();
        return response()->json($products);
    }

    public function LoginPelanggan(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Query untuk mencari pengguna berdasarkan email dan password
        $user = DB::table('costumer')
            ->join('product', 'costumer.id_product', '=', 'product.id')
            ->select('costumer.status', 'costumer.name', 'costumer.id', 'product.name_product')
            ->where('costumer.email', $email)
            ->where('costumer.password', $password)
            ->first();

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Logged in successfully',
                'status' => $user->status,
                'name' => $user->name,
                'id' => $user->id,
                'name_product' => $user->name_product,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ]);
        }
    }

    public function getRiwayat()
    {
        $riwayat = DB::table('costumer')
        ->join('product', 'costumer.id_product', '=', 'product.id')
        ->join('transaction', 'costumer.id', '=', 'transaction.id_costumer')
        ->join('users', 'transaction.users', '=', 'users.id')
        ->select('costumer.*', 'product.*', 'transaction.*', 'users.*')
        ->get();

        return response()->json($riwayat);
    }
}
