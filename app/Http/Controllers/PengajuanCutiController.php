<?php

namespace App\Http\Controllers;

use App\Models\PengajuanCuti;
use Illuminate\Http\Request;

class PengajuanCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = PengajuanCuti::all();
        $list_type = ['Sakit', 'Izin', 'Cuti', 'Lainnya'];

        return view('pages.pengajuan-cuti.index', [
            'items' => $items,
            'list_type' => $list_type,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['status'] = 'PENDING';

        PengajuanCuti::create($data);

        return redirect()->route('pengajuan-cuti.index')->with('success', 'Pengajuan cuti berhasil diajukan');
    }

    /**
     * Display the specified resource.
     */
    public function show(PengajuanCuti $pengajuanCuti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengajuanCuti $pengajuanCuti)
    {
        $data = $request->all();
        $pengajuanCuti->update($data);

        return redirect()->route('pengajuan-cuti.index')->with('success', 'Pengajuan cuti berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengajuanCuti $pengajuanCuti)
    {
        //
    }
}
