<?php

namespace App\Http\Controllers;

use App\Models\PemesananProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PemesananProdukController extends Controller
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

    public function pemesananProdukAll()
    {
        return view('pemesanan_produk.all_tipe_user.pemesanan_produk');
    }

    // Pemesanan dari Costumer
    public function pemesananProduk(Request $request)
    {
        $request->validate([
            'jumlah_barang' => 'required',
            'tanggal_pengiriman' => 'required',
        ], [
            'jumlah_barang.required' => 'Jumlah Produk wajib di isi',
            'tanggal_pengiriman.required' => 'Tanggal Pengiriman Produk wajib di isi',
        ]);

        $id_pemesanan_produk = $this->generateID('PM', 'pemesanan_produk', 'id_pemesanan_produk');

        $pembelian = new PemesananProduk();
        $pembelian->id_pemesanan_produk = $id_pemesanan_produk;
        $pembelian->id_produk = $request->id_produk;
        $pembelian->id = $request->id;
        $pembelian->jumlah_produk = $request->jumlah_barang;
        $pembelian->nama_perusahaan = $request->nama_perusahaan;
        $pembelian->tanggal_pengiriman = $request->tanggal_pengiriman;
        $pembelian->status = 'waiting';

        $data = $pembelian->save();

        if ($data) {
            return response()->json([
                'status' => 'success',
                'message' => 'Pemesanan produk berhasil, silahkan cek menu pemesanan produk di bagian detail pemesanan produk anda untuk proses selanjutnya, Terima Kasih...',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Pemesanan produk gagal',
            ]);
        }
    }

    // Untuk Costumer

    // Ambil data pemesanan produk untuk Costumer
    public function dataProdukOfficer()
    {
        $id_user = Auth::user()->id;

        $data = PemesananProduk::where('id', $id_user)->orderBy('created_at', 'desc')->with('produk', 'user')->get();

        return datatables()->of($data)->make(true);
    }

    // Proses mengambil satu data pemesanan produk untuk officer untuk diubah
    public function ubahPemesananProdukOfficer($id_pemesanan_produk)
    {
        $pemesanan_produk = PemesananProduk::with('produk', 'user')->findOrFail($id_pemesanan_produk);
        $hargaProduk = formatRupiah($pemesanan_produk->produk->harga * $pemesanan_produk->jumlah_produk);

        if ($pemesanan_produk) {
            return response()->json([
                'status' => 'success',
                'hargaProduk' => $hargaProduk,
                'pemesanan_produk' => $pemesanan_produk
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Data pemesanan produk tidak ditemukan'
            ]);
        }
    }

    // Untuk Merchant

    // Ambil data pemesanan produk untuk Merchant
    public function dataPemesananMerchant()
    {
        $nama_perusahaan = Auth::user()->name;

        $data = PemesananProduk::where('nama_perusahaan', $nama_perusahaan)->orderBy('created_at', 'desc')->with('produk', 'user')->get();

        return datatables()->of($data)->make(true);
    }

    // Approve data pemesanan produk untuk merchant
    public function approve_merchant(PemesananProduk $pemesananProduk, Request $request, $id_pemesanan_produk)
    {
        if ($request->ajax()) {

            $pemesananProduk = PemesananProduk::findOrFail($id_pemesanan_produk);

            if ($pemesananProduk) {

                $pemesananProduk->update([
                    'status' => 'approved',
                ]);

                return response()->json(array('success' => true));
            }
        }
    }
}
