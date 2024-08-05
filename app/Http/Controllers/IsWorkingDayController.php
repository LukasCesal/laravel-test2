<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holidays;
use Illuminate\Support\Facades\DB;


class IsWorkingDayController extends Controller
{
    public function index()
    {
        $holidays = Holidays::all();
        return response()->json($holidays);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Holidays $holiday
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {


        $country = strip_tags($request->country);
        $day = (int)$request->day;
        $month = (int)$request->month;
        $year = (int)$request->year;
        $timestamp = mktime(0, 0, 0, $month, $day, $year);
        $dayOfWeek = date('w', $timestamp);
        $isWorking = true;
        $comment = '';
        if ($dayOfWeek == 0 or $dayOfWeek == 6) {
            $isWorking = false;
            $comment = 'weekend';
        } elseif ($this->isValidDateRange($day, $month, $year)
        ) {

            if (easter_date($year) - (2 * 86400) < $timestamp && (easter_date($year) + (2 * 86400)) > $timestamp) {
                $isWorking = false;
                $comment = 'Easter holiday';
            } elseif (null !== ($record = DB::table('holidays')
                    ->where('country', $country)
                    ->where('day', $day)
                    ->where('month', $month)->first())) {
                $isWorking = false;
                $comment = $record->name;
            }


        } else {
            return response()->json(['message' => 'Invalid search criteria.'], 403);
        }
        return response()->json(['workingday' => $isWorking, 'comment' => $comment], 200);

    }

    public function store(Request $request, $day, $month, $year)
    {
        $holiday = new Holidays;
        $holiday->name = mb_substr(strip_tags($request->name), 0, 256);
        $holiday->country = strip_tags($request->country);
        $holiday->day = (int)$request->day;
        $holiday->month = (int)$request->month;
        if (
            $this->isValidDateRange($holiday->day, $holiday->month)
        ) {
            try {
                $holiday->save();
                return response()->json(['message' => 'Holiday added.'], 201);
            } catch (\Exception $exception) {
                return response()->json(['message' => 'Error saving new holiday.'], 500);
            }

        } else {
            $holiday->save();
            return response()->json(['message' => 'Invalid input.'], 403);
        }
    }

    protected function isValidDateRange($day, $month, $year = null)
    {
        if ($day > 0 && $day <= 31 && $month > 0 && $month <= 12) {
            if ($year === null) {
                return true;
            } else {
                return checkdate($month, $day, $year);
            }
        }
        return false;
    }
}
