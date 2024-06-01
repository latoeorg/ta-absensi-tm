<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QrCode;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QrCodeController extends Controller
{

    public function generate()
    {
        // Check if the user is a super admin
        $isSuperAdmin = Auth::user()->isSuperAdmin();

        $date = Carbon::now()->toDateString();

        $qrCode = QrCode::where('date', $date)->first();

        if (!$qrCode) {
            // Generate the QR code
            $qrCodeData = route('login-attendance'); // Use the appropriate route name here

            $result = Builder::create()
                ->writer(new PngWriter())
                ->writerOptions([])
                ->data($qrCodeData)
                ->encoding(new Encoding('UTF-8'))
                ->errorCorrectionLevel(ErrorCorrectionLevel::Low) // Adjust the error correction level
                ->size(500)
                ->margin(10)
                ->build();

            $qrCode = new QrCode([
                'code' => base64_encode($result->getString()),
                'date' => Carbon::now()
            ]);
            $qrCode->save();
        }

        return view('pages.qr.generate', [
            'qrCode' => $qrCode,
            'isSuperAdmin' => $isSuperAdmin
        ]);
    }

    public function scan()
    {
        $date = Carbon::now()->toDateString();
        $user = Auth::user();

        // Check if the user already has clocked in today
        $attendance = $user->attendances()->where('date', $date)->first();

        if ($attendance) {
            // Clock out
            $attendance->clock_out = Carbon::now();
            $attendance->save();
            $message = 'Clocked out successfully';
        } else {
            // Clock in
            $attendance = $user->attendances()->create([
                'date' => $date,
                'clock_in' => Carbon::now()
            ]);
            $message = 'Clocked in successfully';
        }

        return redirect()->route('attendance.index')->with('status', $message);
    }
}
