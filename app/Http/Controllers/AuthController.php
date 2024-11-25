<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\QrCode;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use DateTimeZone;

class AuthController extends Controller
{
    private function generateQrCode(Request $request)
    {
        $baseUrl = $request->root();
        $date = Carbon::now()->toDateString();

        $qrCode = QrCode::where('date', $date)->first();

        if (!$qrCode) {
            // Generate the QR code
            // Get the current domain or IP address
            $qrCodeData = $baseUrl . '/scan-qr'; // Use the appropriate route name here

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
                'date' => Carbon::now(),
            ]);
            $qrCode->save();
        }

        return $qrCode;
    }

    public function index(Request $request)
    {
        // Check if the user intended to visit a specific URL before being redirected to login
        if ($request->has('intended')) {
            session(['url.intended' => $request->intended]);
        }

        return view('pages.auth.login-attendance', [
            'qrCode' => $this->generateQrCode($request),
        ]); // Ensure this points to the correct view file
    }

    public function authenticate(Request $request)
    {
        $credentials = ['password' => $request->password];

        if (filter_var($request->useremail, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $request->useremail;
        } else {
            $credentials['username'] = $request->useremail;
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $request->session()->put('user', $user);
            $currentRoute = $request->route()->getName();
            info('Current Route: ' . $currentRoute);

            // Redirect to the intended URL after login or default to home
            return redirect('/');
        }

        return back()->with('error', 'Email atau Password salah');
    }

    public function authenticateAttendance(Request $request)
    {
        $credentials = ['password' => $request->password];

        if (filter_var($request->useremail, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $request->useremail;
        } else {
            $credentials['username'] = $request->useremail;
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $request->session()->put('user', $user);
            $currentRoute = $request->route()->getName();
            info('Current Route: ' . $currentRoute);

            // // Call scan function from QrCodeController
            // app(QrCodeController::class)->scan();

            // Auth::logout();
            return redirect('/')->with('status', 'You have been logged out after attendance.');
        }

        return back()->with('error', 'Email atau Password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
