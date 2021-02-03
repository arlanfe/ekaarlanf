<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
use App\Buku;

class BookController extends Controller
{
    public function book() {
        $data = "Data All Book";
        return response()->json($data, 200);
    }

    public function bookAuth() {
        $data = "Welcome " . Auth::user()->name;
        return response()->json($data, 200);
    }

    public function index() {
        $buku = Buku::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Post',
            'data'    => $buku  
        ], 200);
        //return Buku::all();
    }

    public function create(Request $request) {
        $buku = new Buku;
        $buku->buku     = $request->buku;
        $buku->penerbit = $request->penerbit;
        $buku->tahun    = $request->tahun;
        $buku->save();

        return "Input Data berhasil";
    }

    public function update(request $request, $id) {
        $nama       = $request->buku;
        $penerbit   = $request->penerbit;
        $tahun      = $request->tahun;

        $buku = Buku::find($id);
        $buku->buku     = $nama;
        $buku->penerbit = $penerbit;
        $buku->tahun    = $tahun;
        $buku->save();

        return response([
            'status'        => 'OK',
            'message'       => 'Ubah Data Berhasil',
            'update-data'   => $buku
        ], 200);
    }

    public function delete($id) {
        $buku = Buku::find($id);
        $buku->delete();

        return "Hapus Data berhasil";
    }
}
