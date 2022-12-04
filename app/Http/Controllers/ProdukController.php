<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::with(['kategori'])->get();
        return view('produk.index', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produk = Produk::all();
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        return view('produk.create', [
            'produk' => $produk,
            'kategori' => $kategori
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = $request->all();
        $simpan =  Produk::create($request->all());

        if ($simpan == TRUE) {
            return redirect()->route('produk.index')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('produk.index')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all();
        return view('produk.edit', [
            'produk' => $produk,
            'kategori' => $kategori,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $item = Produk::findOrFail($id);

        $simpan = $item->update($data);

        if ($simpan == TRUE) {
            return redirect()->route('produk.index')->with('success', 'Data berhasil Di Update');
        } else {
            return redirect()->route('produk.index')->with('error', 'Data gagal Di Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Produk::findOrFail($id);
        $simpan = $item->delete();

        if ($simpan == TRUE) {
            return redirect()->route('produk.index')->with('success', 'Data berhasil Di Hapus');
        } else {
            return redirect()->route('produk.index')->with('error', 'Data gagal Hapus');
        }
    }
}
