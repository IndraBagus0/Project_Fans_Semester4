<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Produk;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Carbon;
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
            ->where('roles', 3) // Memeriksa apakah role adalah 3
            ->first();

        if ($user && password_verify($password, $user->password)) {
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
        $date = date("Y-m-d");
        DB::table('costumer')->where('id', $id)->update(['status' => 'active', 'subcribe_date' => $date]);

        echo "Data Updated";
    }

    public function register()
    {
        $username = request()->input('username');
        $email = request()->input('email');
        $password = Hash::make(request()->input('password'));
        $phone_number = request()->input('phone_number');
        $address = request()->input('address');
        $date = date("Y-m-d");
        DB::table('costumer')->insert([
            'name' => $username,
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'phone_number' => $phone_number,
            'status' => 'non active',
            'address' => $address,
            'id_product' => 1,
            'subcribe_date' => $date,
            'image' => '',
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

        // Query untuk mencari pengguna berdasarkan email
        $user = DB::table('costumer')
            ->join('product', 'costumer.id_product', '=', 'product.id')
            ->select('costumer.*', 'product.name_product')
            ->where('costumer.email', $email)
            ->first();

        if ($user) {
            // Memeriksa kecocokan password menggunakan Hash::check()
            if (Hash::check($password, $user->password)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Logged in successfully',
                    'status' => $user->status,
                    'name' => $user->name,
                    'id' => $user->id,
                    'name_product' => $user->name_product,
                    'email' => $user->email,
                    'address' => $user->address,
                    'phone_number' => $user->phone_number,
                    'subcribe_date' => $user->subcribe_date,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid password',
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ]);
        }
    }

    public function getRiwayat()
    {
        $riwayat = DB::table('transaction')
            ->join('costumer', 'costumer.id', '=', 'transaction.id_costumer')
            ->join('product', 'product.id', '=', 'costumer.id_product')
            ->select('transaction.*', 'costumer.*', 'product.*')
            ->get();

        return response()->json($riwayat);
    }

    public function updateProfil()
    {
        $id = request()->input('id');
        $name = request()->input('name');
        $email = request()->input('email');
        $phone_number = request()->input('phone_number');
        $address = request()->input('address');

        DB::table('costumer')->where('id', $id)->update([
            'name' => $name,
            'username' => $name,
            'email' => $email,
            'phone_number' => $phone_number,
            'address' => $address
        ]);

        return "Data Updated";
    }

    public function updatePassword()
    {
        $id = request()->input('id');
        $password = request()->input('password');

        $hashedPassword = Hash::make($password);

        DB::table('costumer')->where('id', $id)->update([
            'password' => $hashedPassword,
        ]);

        return "Data Updated";
    }
    public function store(Request $request)
    {
        $user = [
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'roles' => $request->input('roles'), // Menggunakan role_id sebagai nama kolom
            'address' => $request->input('address')
        ];

        DB::table('users')->insert($user);

        return response()->json(['message' => 'Admin berhasil ditambahkan.'], 201);
    }

    public function edit(Request $request)
    {
        $id = $request->input('id');
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'message' => 'Pelanggan tidak ditemukan.',
            ], 404);
        }

        $customer->status = "active";

        if ($customer->status === 'active') {
            $customer->subcribe_date = Carbon::now()->toDateString();
            $expireDate = Carbon::now()->addDays(30)->toDateString();

            Schedule::create([
                'customer_id' => $customer->id,
                'status' => 'non active',
                'expire_date' => $expireDate,
            ]);
        } else {
            Schedule::where('customer_id', $customer->id)->delete();
            $customer->subcribe_date = null;
        }

        $customer->save();

        return response()->json([
            'message' => 'Berhasil',
            'customer' => $customer,
        ]);
    }

    public function uploadImage(Request $request)
    {
        $customerId = $request->input('id');

        // Mengecek apakah kolom "image" sudah terisi atau tidak
        $existingImage = DB::table('costumer')
                        ->where('id', $customerId)
                        ->value('image');

        if ($existingImage) {
            // Jika kolom "image" sudah terisi, kembalikan respons yang sesuai
            return response()->json('Anda sudah mengupload gambar sebelumnya, admin sedang memprosesnya', 200);
        } else {
            // Jika kolom "image" masih kosong, lanjutkan dengan proses mengupload gambar
            if ($request->has('image')) {
                $image = $request->input('image');
                $imageStore = time() . '_' . uniqid() . '.jpeg';
                $targetPath = public_path('images/') . $imageStore;
                file_put_contents($targetPath, base64_decode($image));

                // Mengupdate kolom "image" pada tabel "customer" berdasarkan ID
                DB::table('costumer')
                    ->where('id', $customerId)
                    ->update(['image' => $imageStore]);

                return response()->json('Gambar berhasil diupload', 200);
            } else {
                return response()->json(['error' => 'No image found'], 400);
            }
        }
    }

    public function costumer(Request $request)
    {
        $customerId = $request->query('costumer_id');

        $query = DB::table('costumer')
            ->join('product', 'product.id', '=', 'costumer.id_product')
            ->select( 'costumer.id as costumer_id','costumer.*', 'product.*');

        if ($customerId) {
            $query->where('costumer.id', $customerId);
        }

        $customers = $query->get();

        return response()->json($customers);
    }

}
