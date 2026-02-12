<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Dashboard — tampilkan total produk & statistik.
     */
    public function index()
    {
        $totalProduk = Produk::count();

        return view('dashboard', compact('totalProduk'));
    }

    /**
     * Halaman admin kelola produk.
     */
    public function admin()
    {
        $produks = Produk::latest()->get();

        return view('admin_produk', compact('produks'));
    }

    /**
     * Simpan produk baru dengan upload gambar.
     */
    public function store(Request $request)
    {
        $request->validate([
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'kategori'  => 'required|string|max:100',
            'produk'    => 'required|string|max:150',
            'harga'     => 'required|integer',
        ]);

        $data = $request->only(['kategori', 'produk', 'harga']);

        // Upload gambar jika ada
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('uploads/produk', 'public');
        }

        Produk::create($data);

        return redirect()->route('produk.admin')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Update produk (termasuk mengganti gambar jika ada file baru).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'kategori'  => 'required|string|max:100',
            'produk'    => 'required|string|max:150',
            'harga'     => 'required|integer',
        ]);

        $produk = Produk::findOrFail($id);
        $data = $request->only(['kategori', 'produk', 'harga']);

        // Jika ada file baru, hapus gambar lama & simpan yang baru
        if ($request->hasFile('thumbnail')) {
            // Hapus gambar lama dari storage
            if ($produk->thumbnail && Storage::disk('public')->exists($produk->thumbnail)) {
                Storage::disk('public')->delete($produk->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('uploads/produk', 'public');
        }

        $produk->update($data);

        return redirect()->route('produk.admin')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Hapus produk sekaligus menghapus file gambarnya dari folder.
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus file gambar dari storage
        if ($produk->thumbnail && Storage::disk('public')->exists($produk->thumbnail)) {
            Storage::disk('public')->delete($produk->thumbnail);
        }

        $produk->delete();

        return redirect()->route('produk.admin')->with('success', 'Produk berhasil dihapus!');
    }
}
