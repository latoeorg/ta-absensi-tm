<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PengajuanCuti;

class ReportCutiController extends Controller
{
    public function index()
    {
        $items = PengajuanCuti::where('status', 'APPROVED')->get();

        return view('pages.report-cuti.index', [
            'items' => $items,
        ]);
    }
}
