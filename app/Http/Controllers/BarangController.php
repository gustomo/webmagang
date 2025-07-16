<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang; // Pastikan model Barang di-import

class BarangController extends Controller
{
    /**
     * Menampilkan daftar semua barang.
     */
    public function index()
    {
        // Mengambil semua data barang dari database
        $barangs = Barang::all();
        // Mengembalikan view 'barang.index' dengan data barangs
        return view('barang.index', compact('barangs'));
    }

    /**
     * Menampilkan form untuk membuat barang baru.
     */
    public function create()
    {
        // Cukup menampilkan view 'barang.create' yang berisi form
        return view('barang.create');
    }

    /**
     * Menyimpan data barang yang baru dibuat ke dalam storage.
     */
    public function store(Request $request)
    {
// 1. Validasi data input dari form
$request->validate([
    'nama_barang' => 'required|string|max:255',
    'satuan'      => 'required|string|in:dos,lusin,krat,sak,rim',
    'isi'         => 'required|integer|min:1',
]);

// 2. Logika untuk membuat ID Barang otomatis (misal: BRG001, BRG002)
try {
    // Cari ID terakhir dengan format 'BRG...'
    $lastBarang = Barang::where('id_brg', 'like', 'BRG%')
        ->selectRaw("MAX(CAST(SUBSTRING(id_brg, 4) AS UNSIGNED)) as max_id")
        ->value('max_id');

    // Tentukan nomor berikutnya. Jika belum ada, mulai dari 1.
    $newNumber = $lastBarang ? $lastBarang + 1 : 1;

    // Buat ID baru dengan format 'BRG' diikuti 3 digit angka (e.g., BRG001)
    $newId = 'BRG' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

    // 3. Buat entri baru di database dengan ID yang sudah dibuat
    Barang::create([
        'id_brg'      => $newId,
        'nama_barang' => $request->nama_barang,
        'satuan'      => $request->satuan,
        'isi'         => $request->isi,
    ]);

    // 4. Redirect ke halaman index dengan pesan sukses
    return redirect()->route('barang.index')
                     ->with('success', 'Barang baru (' . $newId . ') berhasil ditambahkan!');

} catch (\Exception $e) {
    // Jika terjadi error, kembali ke form dengan pesan error
    return redirect()->back()
                     ->withInput()
                     ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
}
    }

    /**
     * Menampilkan detail dari satu barang spesifik.
     */
    public function show(string $id)
    {
        // Logika untuk menampilkan detail barang bisa ditambahkan di sini
        $barang = Barang::findOrFail($id);
        return view('barang.show', compact('barang'));
    }

    /**
     * Menampilkan form untuk mengedit data barang.
     */
    public function edit(string $id)
    {
        // Logika untuk menampilkan form edit
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    /**
     * Memperbarui data barang yang ada di storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'nama_barang' => 'required|string|max:255',
            'satuan'      => 'required|string|in:dos,lusin,krat,sak,rim',
            'isi'         => 'required|integer|min:1',
        ]);

        try {
            // 2. Cari barang yang akan diupdate
            $barang = Barang::findOrFail($id);

            // 3. Update data barang dengan data dari form
            $barang->update([
                'nama_barang' => $request->nama_barang,
                'satuan'      => $request->satuan,
                'isi'         => $request->isi,
            ]);

            // 4. Redirect ke halaman index dengan pesan sukses
            return redirect()->route('barang.index')
                             ->with('success', 'Data barang (' . $barang->id_brg . ') berhasil diperbarui!');

        } catch (\Exception $e) {
            // Jika terjadi error, kembali ke form edit dengan pesan error
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus data barang dari storage.
     */
    public function destroy(string $id)
    {
        try {
            $barang = Barang::findOrFail($id);
            $namaBarang = $barang->nama_barang;

            $barang->delete();

            return redirect()->route('barang.index')
                             ->with('success', 'Barang (' . $namaBarang . ') berhasil dihapus.');

        } catch (\Exception $e) {
           
            return redirect()->route('barang.index')
                             ->with('error', 'Gagal menghapus barang: ' . $e->getMessage());
        }
    }

    public function printAll()
    {
        $barangs = \App\Models\barang::all();
        $pdf = 'PDF'::loadview('barang.print_all',compact('barangs'));
        return $pdf->stream('laporan-semua-barang.pdf');
    }

}