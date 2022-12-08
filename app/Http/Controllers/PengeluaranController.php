<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pengeluaran::all();
        // return response()->json($data);
        if (request()->ajax()) {
            return datatables()->of($data)
                // ->addIndexColumn()
                ->addColumn('created_at', function ($data) {
                    return tanggal_indonesia($data->created_at);
                })
                ->addColumn('nominal', function ($data) {
                    return format_uang($data->nominal);
                })
                ->addColumn('aksi', function ($data) {
                    $button = ' <button class="edit btn btn-sm btn-warning" id="' . $data->id_pengeluaran . '" name="edit">Edit</button> ';
                    $button .= ' <button class="hapus btn btn-sm btn-danger" id="' . $data->id_pengeluaran . '" name="hapus">Hapus</button> ';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('pengeluaran.index');
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
        $rules = [
            'deskripsi' => 'required',
            'nominal' => 'required',
        ];

        $text = [
            'deskripsi.required' => 'Kolom Nama Tidak Boleh Kosong',
            'nominal.required' => 'Kolom Telepon Tidak Boleh Kosong',
        ];

        $validasi = Validator::make($request->all(), $rules, $text);

        if ($validasi->fails()) {
            return response()->json(['success' => 0, 'text' => $validasi->errors()->first()], 400);
        }
        // dd($request->all());
        $simpan = Pengeluaran::create($request->all());

        if ($simpan) {
            return response()->json(['text' => 'Data Berhasil Di Simpan'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Di Simpan'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data = Pengeluaran::find($request->id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = Pengeluaran::find($request->id);
        $simpan = $data->update($request->all());

        if ($simpan) {
            return response()->json(['text' => 'Data Berhasil Di Update'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Di Update'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengeluaran  $pengeluaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = Pengeluaran::find($request->id);
        $simpan = $data->delete($request->all());

        if ($simpan) {
            return response()->json(['text' => 'Data Berhasil Di Hapus'], 200);
        } else {
            return response()->json(['text' => 'Data Gagal Di Hapus'], 400);
        }
    }
}
