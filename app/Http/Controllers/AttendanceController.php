<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::where('user_id', Auth::id())->orderBy('date', 'desc')->get();
        return view('pages.attendance.index', compact('attendances'));
    }

    public function clockIn()
    {
        $date = Carbon::now()->toDateString();
        $attendance = Attendance::updateOrCreate(
            ['user_id' => Auth::id(), 'date' => $date],
            ['clock_in' => Carbon::now()]
        );

        return response()->json(['message' => 'Clocked in successfully', 'attendance' => $attendance]);
    }

    public function clockOut()
    {
        $date = Carbon::now()->toDateString();
        $attendance = Attendance::where('user_id', Auth::id())->where('date', $date)->first();

        if ($attendance) {
            $attendance->clock_out = Carbon::now();
            $attendance->save();

            return response()->json(['message' => 'Clocked out successfully', 'attendance' => $attendance]);
        }

        return response()->json(['message' => 'Clock in first'], 400);
    }
}
