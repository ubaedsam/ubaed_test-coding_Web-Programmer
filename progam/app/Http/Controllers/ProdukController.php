<?php

namespace App\Http\Controllers;

use App\Models\PemesananProduk;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function generateID($prefix, $tableName, $columnName, $aditionalWhere = null)
    {
        $prefixLength = strlen($prefix);

        $numberBefore = DB::table($tableName)
            ->selectRaw('SUBSTR(' . $columnName . ', ' . ($prefixLength + 1) . ') as code')
            ->orderByRaw('CAST(SUBSTR(' . $columnName . ', ' . ($prefixLength + 1) . ') AS SIGNED) desc')
            ->whereRaw('SUBSTR(' . $columnName . ',1, ' . ($prefixLength) . ') = \'' . $prefix . '\'');

        if ($aditionalWhere != null) {
            $numberBefore = $numberBefore->whereRaw($aditionalWhere);
        }

        $numberBefore = $numberBefore->first();

        if ($numberBefore == null) {
            return $prefix . '00001';
        }

        $currentNumber = (int)$numberBefore->code + 1;

        switch ($currentNumber) {
            case $currentNumber < 10:
                $currentCode = $prefix . '0000' . $currentNumber;
                break;
            case $currentNumber < 100:
                $currentCode = $prefix . '000' . $currentNumber;
                break;
            case $currentNumber < 1000:
                $currentCode = $prefix . '00' . $currentNumber;
                break;
            case $currentNumber < 10000:
                $currentCode = $prefix . '0' . $currentNumber;
                break;
            default:
                $currentCode = $prefix . $currentNumber;
                break;
        }

        return $currentCode;
    }

    public function index()
    {
        $this->authorize('checkmerchant');

        return view('produk.list_produk');
    }

    // Ambil data produk
    public function dataProduk()
    {
        $nama_perusahaan = Auth::user()->name;

        $data = Produk::where('nama_perusahaan', $nama_perusahaan)->orderBy('created_at', 'desc')->get();

        return datatables()->of($data)->make(true);
    }

    // Proses simpan data produk
    public function storeProduk(Request $request)
    {
        $cekProduk = Produk::where('nama_produk', $request->nama_produk)->where('jenis_produk', $request->jenis_produk)->first();

        if ($cekProduk) {
            return response()->json([
                'status' => 'error',
                'message' => 'Produk ini sudah ada',
            ]);
        }

        $id_produk = $this->generateID('P', 'produk', 'id_produk');

        $produk = new Produk();

        $produk->id_produk = $id_produk;
        $produk->nama_perusahaan = $request->nama_perusahaan;
        $produk->nama_produk = $request->nama_produk;
        $produk->jenis_produk = $request->jenis_produk;
        $produk->deskripsi_produk = $request->deskripsi_produk;
        $produk->harga = $request->harga;
        $produk->lokasi = $request->lokasi;

        if ($request->hasfile('foto')) {
            $file = $request->file('foto');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('dist/img/produk/', $filename);
            $produk->foto = $filename;
        }

        $data = $produk->save();

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data Produk berhasil disimpan',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data Produk gagal disimpan',
            ]);
        }
    }

    // Proses mengambil satu data produk untuk diubah
    public function ubahProduk($id_produk)
    {
        $produk = Produk::findOrFail($id_produk);

        if ($produk) {
            return response()->json([
                'status' => 'success',
                'produk' => $produk
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data produk tidak ditemukan'
            ]);
        }
    }

    // Proses mengubah data produk
    public function prosesUbahProduk(Request $request)
    {
        $id_produk = $request->id_produk;

        $produk = Produk::find($id_produk);

        if (!$produk) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data produk tidak ditemukan',
            ]);
        }

        $produk->nama_produk = $request->nama_produk;
        $produk->jenis_produk = $request->jenis_produk;
        $produk->deskripsi_produk = $request->deskripsi_produk;
        $produk->harga = $request->harga;
        $produk->lokasi = $request->lokasi;

        if ($request->hasfile('foto')) {
            $destination = 'dist/img/produk/' . $produk->foto;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('foto');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('dist/img/produk/', $filename);
            $produk->foto = $filename;
        }

        if ($produk->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data produk berhasil diubah',
                'produk' => $produk,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update produk',
            ]);
        }
    }

    // Proses menghapus data produk
    public function prosesHapusProduk(Request $request, $id_produk)
    {
        if ($request->ajax()) {

            $produkExists = PemesananProduk::where('id_produk', $id_produk)->exists();

            if ($produkExists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data produk ini tidak bisa dihapus karena sudah digunakan'
                ]);
            } else {
                $produk = Produk::findOrFail($id_produk);

                if ($produk) {

                    $produk->delete();

                    return response()->json(array('success' => true));
                }
            }
        }
    }
}
