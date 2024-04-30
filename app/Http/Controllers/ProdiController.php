<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodis = Prodi::all();

        return view('prodi.index', compact('prodis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $prodi = new Prodi();

        $prodi->kode = $request->kode;
        $prodi->nama = $request->nama;

        $prodi->save();

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Prodi $prodi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prodi $prodi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $prodi = Prodi::where('id', $id);

        $prodi->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        Prodi::where('id', $id)->delete();

        return back();
    }
}
