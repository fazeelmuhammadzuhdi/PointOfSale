<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Kategori::all();
        return view('kategori.index', [
            'item' => $item
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = Kategori::all();
        return view('kategori.create', [
            'item' => $item
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
        $simpan =  Kategori::create($request->all());

        if ($simpan == TRUE) {
            return redirect()->route('kategori.index')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('kategori.index')->with('error', 'Data gagal disimpan');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Kategori::findOrFail($id);
        return view('kategori.edit', [
            'item' => $item,
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
        $item = Kategori::findOrFail($id);

        $simpan = $item->update($data);

        if ($simpan == TRUE) {
            return redirect()->route('kategori.index')->with('success', 'Data berhasil Di Update');
        } else {
            return redirect()->route('kategori.index')->with('error', 'Data gagal Update');
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
        $item = Kategori::findOrFail($id);
        $simpan = $item->delete();

        if ($simpan == TRUE) {
            return redirect()->route('kategori.index')->with('success', 'Data berhasil Di Hapus');
        } else {
            return redirect()->route('kategori.index')->with('error', 'Data gagal Hapus');
        }
    }
}
