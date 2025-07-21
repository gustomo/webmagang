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
    $request->validate([
        'nama_barang' => 'required',
        'satuan' => 'required',
        'isi' => 'required|numeric',
        'stok' => 'required|numeric',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $input = $request->all();

    // Generate id_brg jika perlu
    $lastBarang = \App\Models\Barang::orderBy('id_brg', 'desc')->first();
    $newNumber = $lastBarang ? ((int)substr($lastBarang->id_brg, 3)) + 1 : 1;
    $input['id_brg'] = 'BRG' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

    // Proses upload gambar
    if ($request->hasFile('gambar')) {
        $destinationPath = 'uploads/barang/';
        $profileImage = date('YmdHis') . "." . $request->file('gambar')->getClientOriginalExtension();
        $request->file('gambar')->move(public_path($destinationPath), $profileImage);
        $input['gambar'] = $profileImage;
    }

    \App\Models\Barang::create($input);

    return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
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
  public function update(Request $request, Barang $barang)
{
    $request->validate([
        'nama_barang' => 'required',
        'satuan' => 'required',
        'isi' => 'required|numeric',
        'stok' => 'required|numeric',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $input = $request->all();

    if ($request->hasFile('gambar')) {
        // Hapus gambar lama jika ada
        if ($barang->gambar && file_exists(public_path('uploads/barang/' . $barang->gambar))) {
            unlink(public_path('uploads/barang/' . $barang->gambar));
        }
        $destinationPath = 'uploads/barang/';
        $profileImage = date('YmdHis') . "." . $request->file('gambar')->getClientOriginalExtension();
        $request->file('gambar')->move(public_path($destinationPath), $profileImage);
        $input['gambar'] = $profileImage;
    } else {
        unset($input['gambar']);
    }

    $barang->update($input);

    return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
}
    /**
     * Menghapus data barang dari storage.
     */
   public function destroy(Barang $barang)
{
    // Hapus gambar terkait jika ada
    if ($barang->gambar && file_exists(public_path('uploads/barang/' . $barang->gambar))) {
        unlink(public_path('uploads/barang/' . $barang->gambar));
    }

    $barang->delete();

    return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
}

    public function printAll()
    {
       $barangs = \App\Models\Barang::all();
        $pdf = \PDF::loadview('barang.print_all', compact('barangs'));
        return $pdf->stream('laporan-semua-barang.pdf');
    }

}