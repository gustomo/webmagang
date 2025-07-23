<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Supplier;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Menampilkan daftar transaksi
     */
    public function index()
    {
        $transaksis = Transaksi::with(['supplier', 'barang'])->latest()->get();
        return view('transaksi.index', compact('transaksis'));
    }

    /**
     * Menampilkan form untuk membuat transaksi baru
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $barangs = Barang::where('stok', '>', 0)->get(); // Hanya tampilkan barang dengan stok tersedia
        return view('transaksi.create', compact('suppliers', 'barangs'));
    }

    /**
     * Menyimpan transaksi baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_sp' => 'required|exists:tb_supplier,id_sp',
            'tanggal_transaksi' => 'required|date',
            'barang' => 'required|array|min:1',
            'barang.*.id_brg' => 'required|exists:tb_barang,id_brg',
            'barang.*.jumlah' => 'required|numeric|min:1',
            'barang.*.harga' => 'required|numeric|min:0'
        ]);

        DB::beginTransaction();

        try {
            // Generate ID Transaksi
            $id_transaksi = 'TRX-' . date('Ymd') . '-' . Str::upper(Str::random(4));

            // Hitung total harga
            $total_harga = 0;
            $items = [];
            
            foreach ($request->barang as $item) {
                $barang = Barang::find($item['id_brg']);
                $subtotal = $item['jumlah'] * $item['harga'];
                
                $items[$item['id_brg']] = [
                    'jumlah' => $item['jumlah'],
                    'satuan' => $barang->satuan,
                    'harga' => $item['harga'],
                    'subtotal' => $subtotal
                ];
                
                $total_harga += $subtotal;
                
                // Kurangi stok barang
                $barang->decrement('stok', $item['jumlah']);
            }

            // Simpan transaksi
            $transaksi = Transaksi::create([
                'id_transaksi' => $id_transaksi,
                'id_sp' => $request->id_sp,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'total_harga' => $total_harga
            ]);

            // Simpan barang-barang yang dibeli
            $transaksi->barang()->attach($items);

            DB::commit();

            return redirect()->route('transaksi.index')
                            ->with('success', 'Transaksi berhasil dibuat dengan ID: ' . $id_transaksi);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membuat transaksi: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan detail transaksi
     */
    public function show($id)
    {
        $transaksi = Transaksi::with(['supplier', 'barang'])->findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }

    /**
     * Menghapus transaksi
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $transaksi = Transaksi::findOrFail($id);
            
            // Kembalikan stok barang
            foreach ($transaksi->barang as $barang) {
                $barang->increment('stok', $barang->pivot->jumlah);
            }
            
            // Hapus relasi barang
            $transaksi->barang()->detach();
            
            // Hapus transaksi
            $transaksi->delete();

            DB::commit();

            return redirect()->route('transaksi.index')
                            ->with('success', 'Transaksi berhasil dihapus');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus transaksi: ' . $e->getMessage());
        }
    }

    /**
     * Cetak invoice transaksi
     */
    public function print($id)
    {
        $transaksi = Transaksi::with(['supplier', 'barang'])->findOrFail($id);
        $pdf = \PDF::loadView('transaksi.print', compact('transaksi'));
        return $pdf->stream('invoice-' . $transaksi->id_transaksi . '.pdf');
    }
}