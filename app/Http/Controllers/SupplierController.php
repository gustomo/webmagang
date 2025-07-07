<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:50',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // ✅ Cari ID terbesar dari id_sp → hindari duplikat
        $lastId = Supplier::where('id_sp', 'like', 'SP%')
            ->selectRaw("MAX(CAST(SUBSTRING(id_sp, 3) AS UNSIGNED)) as max_id")
            ->value('max_id');

        $newNumber = $lastId ? $lastId + 1 : 1;
        $newId = 'SP' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        // Simpan data
        $data = $request->except('foto');
        $data['id_sp'] = $newId;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/supplier'), $filename);
            $data['foto'] = $filename;
        }
        Supplier::create($data);
        return redirect()->route('supplier.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id_supplier)
    {
        $supplier = Supplier::findOrFail($id_supplier);
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:50',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($supplier->foto && file_exists(public_path('uploads/supplier/' . $supplier->foto))) {
                unlink(public_path('uploads/supplier/' . $supplier->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/supplier'), $filename);
            $data['foto'] = $filename;
        }

        $supplier->update($data);
        return redirect()->route('supplier.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        // Hapus foto jika ada
        if ($supplier->foto && file_exists(public_path('uploads/supplier/' . $supplier->foto))) {
            unlink(public_path('uploads/supplier/' . $supplier->foto));
        }

        $supplier->delete();
        return redirect()->route('supplier.index')->with('success', 'Data berhasil dihapus');
    }

    public function show($id)
    {
        // Cari supplier di database berdasarkan ID
        $supplier = Supplier::findOrFail($id); // findOrFail akan otomatis error 404 jika tidak ditemukan

        // Kirim data supplier ke view 'supplier.show'
        return view('supplier.show', compact('supplier'));
    }
    

    /**
     * Menampilkan halaman cetak untuk semua data supplier.
     */
    public function printAll()
    {
        $suppliers = \App\Models\Supplier::all();
        $pdf = 'PDF'::loadview('supplier.print_all',compact('suppliers'));
        return $pdf->stream('laporan-semua-supplier.pdf');
    }
    
}
