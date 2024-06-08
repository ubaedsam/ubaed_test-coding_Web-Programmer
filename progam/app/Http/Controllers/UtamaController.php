<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UtamaController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function getProduk(Request $request)
    {
        $nama_produk = $request->nama_produk;
        $jenis_produk = $request->jenis_produk;
        $page = $request->page ?? 1; // Ambil halaman saat ini atau default ke 1
        $perPage = 10; // Jumlah data per halaman

        $query = Produk::orderBy('created_at', 'desc');

        if ($nama_produk) {
            $nama_produkTerms = explode(' ', $nama_produk);
            foreach ($nama_produkTerms as $term) {
                $query = $query->where('nama_produk', 'like', '%' . $term . '%');
            }
        }

        if ($jenis_produk) {
            $query = $query->where('jenis_produk', $jenis_produk);
        }

        $produks = $query->paginate($perPage, ['*'], 'page', $page);

        $response = array();
        foreach ($produks as $produk) {
            $response[] = array(
                "id_produk" => $produk->id_produk,
                "nama_produk" => $produk->nama_produk,
                "foto" => $produk->foto,
                "jenis_produk" => $produk->jenis_produk,
                "deskripsi_produk" => $produk->deskripsi_produk,
                "lokasi" => $produk->lokasi,
                "harga" => formatRupiah($produk->harga),
            );
        }

        return response()->json([
            'data' => $response,
            'pagination' => [
                'total' => $produks->total(),
                'per_page' => $produks->perPage(),
                'current_page' => $produks->currentPage(),
                'last_page' => $produks->lastPage(),
                'from' => $produks->firstItem(),
                'to' => $produks->lastItem()
            ]
        ]);
    }

    public function checkProduk($id_produk)
    {
        if (Auth::check()) {
            $id_user = Auth::user()->id;
            $dataProduk = Produk::where('id_produk', $id_produk)->first();
            $hargaProduk = formatRupiah($dataProduk->harga);

            return response()->json([
                'status' => 'success',
                'user' => $id_user,
                'produk' => $dataProduk,
                'hargaProduk' => $hargaProduk,
            ]);
        } else {
            return response()->json([
                'status' => 'redirect',
            ]);
        }
    }

    public function updateQuantity(Request $request)
    {
        $productId = $request->input('id');
        $quantity = $request->input('quantity');

        $product = Produk::find($productId);

        if ($product) {
            $convertHarga = $product->harga * $quantity;

            $newHarga = formatRupiah($convertHarga);

            return response()->json([
                'success' => true,
                'quantity' => $quantity,
                'newHarga' => $newHarga
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }
}
