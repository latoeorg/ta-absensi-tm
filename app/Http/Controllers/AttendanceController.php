<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::where('user_id', Auth::id())->orderBy('date', 'desc')->get();
        return view('pages.attendance.index', compact('attendances'));
    }

    public function clockIn(Request $request)
    {
        // $clientTime = $request->input('local_time');
        $clockInTime = Carbon::now(new DateTimeZone('Asia/Bangkok'));

        $date = $clockInTime->toDateString();
        $attendance = Attendance::updateOrCreate(
            ['user_id' => Auth::id(), 'date' => $date],
            ['clock_in' => $clockInTime]
        );

        return response()->json(['message' => 'Clocked in successfully', 'attendance' => $attendance]);
    }

    public function clockOut(Request $request)
    {
        // $clientTime = $request->input('local_time');
        $clockOutTime = Carbon::now(new DateTimeZone('Asia/Bangkok'));

        $date = $clockOutTime->toDateString();
        $attendance = Attendance::where('user_id', Auth::id())->where('date', $date)->first();

        if ($attendance) {
            $attendance->clock_out = $clockOutTime;
            $attendance->save();

            return response()->json(['message' => 'Clocked out successfully', 'attendance' => $attendance]);
        }

        return response()->json(['message' => 'Clock in first'], 400);
    }

    public function allAttendance(Request $request)
    {
        $query = Attendance::query();

        if ($request->has('from_date') && $request->has('to_date')) {
            $query->whereBetween('date', [$request->input('from_date'), $request->input('to_date')]);
        }

        $attendances = $query->with('user')->orderBy('date', 'desc')->get();

        return view('pages.attendance.all', compact('attendances'));
    }
}
