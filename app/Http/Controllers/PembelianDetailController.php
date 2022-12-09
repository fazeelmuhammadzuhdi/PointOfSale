<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\PembelianDetail;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PembelianDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_pembelian = session('id_pembelian');
        $produk = Produk::all();
        $supplier = Supplier::find(session('id_supplier'));

        if (!$supplier) {
            abort(404);
        }
        return view('pembelian-detail.index', compact('id_pembelian', 'produk', 'supplier'));
    }

    public function data($id)
    {
        $data = PembelianDetail::with('produk')->where('id_pembelian', $id)->get();

        // return response()->json($data);
        if (request()->ajax()) {
            return datatables()->of($data)
                ->addColumn('nama_produk', function ($data) {
                    return $data->produk['nama_produk'];
                })
                ->addColumn('kode_produk', function ($data) {
                    return $data->produk['kode_produk'];
                })
                ->addColumn('harga_beli', function ($data) {
                    return 'Rp. ' . $data->harga_beli;
                })
                ->addColumn('jumlah', function ($data) {
                    return '<input type="number" class="form-control input-sm quantity" data-id="' . $data->id_pembelian_detail . '" value="' . $data->jumlah . '">';
                })
                ->addColumn('subtotal', function ($data) {
                    return 'Rp. ' . $data->subtotal;
                })
                ->addColumn('aksi', function ($data) {
                    return '<div class="btn-group">
                                    <button onclick="deleteData(`' . route('pembelian-detail.destroy', $data->id_pembelian_detail) . '`)" class="btn btn-danger btn-sm"><i class="fa fa-trash"> Hapus</i></button>
                                </div>';
                })
                ->rawColumns(['aksi', 'kode_produk', 'jumlah'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produk = Produk::where('id_produk', $request->id_produk)->first();
        if (!$produk) {
            return response()->json('Data gagal disimpan', 400);
        }

        $detail = new PembelianDetail();
        $detail->id_pembelian = $request->id_pembelian;
        $detail->id_produk = $produk->id_produk;
        $detail->harga_beli = $produk->harga_beli;
        $detail->jumlah = 1;
        $detail->subtotal = $produk->harga_beli;
        $detail->save();

        return response()->json('Data berhasil disimpan', 200);
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
        //
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
        $detail = PembelianDetail::find($id);
        $detail->jumlah = $request->jumlah;
        $detail->subtotal = $detail->harga_beli * $request->jumlah;
        $detail->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = PembelianDetail::find($id);
        $simpan = $data->delete();

        if ($simpan) {
            return response()->json(['text' => 'Data Berhasil Di Hapus'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Di Hapus'], 400);
        }
    }
}
