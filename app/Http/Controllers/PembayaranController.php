<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembayaran = Pembayaran::all();
        $jan = Pembayaran::sum('jan');
        $feb = Pembayaran::sum('feb');
        $mar = Pembayaran::sum('mar');
        $apr = Pembayaran::sum('apr');
        $mei = Pembayaran::sum('mei');
        $jun = Pembayaran::sum('jun');

        return view('pembayaran.pembayaran', compact('pembayaran', 'jan', 'feb', 'mar', 'apr', 'mei', 'jun'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pembayaran = new Pembayaran();

        $pembayaran->nis = $request->nis;
        $pembayaran->nama = $request->nama;
        $pembayaran->kelas = $request->kelas;

        if ($request->jan) $pembayaran->jan = $request->jan;
        if ($request->feb) $pembayaran->feb = $request->feb;
        if ($request->mar) $pembayaran->mar = $request->mar;
        if ($request->apr) $pembayaran->apr = $request->apr;
        if ($request->mei) $pembayaran->mei = $request->mei;
        if ($request->jun) $pembayaran->jun = $request->jun;

        $pembayaran->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $nis)
    {
        Pembayaran::where('nis', $nis)->delete();

        return back();
    }
}
