<?php

namespace App\Http\Controllers;

use App\Exports\JadwalsExport;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class JadwalKuliahController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwals = JadwalKuliah::all();

        return view('jadwal-kuliah.index', compact('jadwals'));
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
        $jadwal = new JadwalKuliah();

        $jadwal->hari = $request->hari;
        $jadwal->mata_kuliah = $request->mata_kuliah;
        $jadwal->waktu_mulai = $request->waktu_mulai;
        $jadwal->waktu_selesai = $request->waktu_selesai;
        $jadwal->ruang = $request->ruang;
        $jadwal->dosen = $request->dosen;
        $jadwal->jumlah_mahasiswa = $request->jumlah_mahasiswa;

        $jadwal->save();

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalKuliah $jadwalKuliah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalKuliah $jadwalKuliah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $jadwal = JadwalKuliah::where('id', $id);

        $jadwal->update([
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'ruang' => $request->ruang,
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        JadwalKuliah::where('id', $id)->delete();

        return back();
    }

    /**
     * Export the specified resource to Excel.
     */
    public function export()
    {
        return Excel::download(new JadwalsExport, 'jadwal-kuliah.xlsx');
    }
}
