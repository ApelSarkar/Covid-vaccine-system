<?php

namespace App\Http\Controllers;

use App\Models\CovidRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VaccineSearchController extends Controller
{
    public function showSearchPage()
    {
        return view('search');
    }
    public function checkStatus(Request $request)
    {
        $request->validate([
            'nid' => 'required',
        ]);

        $nid = $request->input('nid');
        $registration = CovidRegistration::where('nid', $nid)->first();

        if (!$registration) {
            return view('status', [
                'status' => 'Not registered',
                'linkToRegister' => route('register'),
            ]);
        }

        $today = Carbon::today();

        if (!$registration->scheduled_date) {
            return view('status', [
                'status' => 'Not scheduled',
            ]);
        } elseif ($registration->scheduled_date > $today) {
            return view('status', [
                'status' => 'Scheduled',
                'scheduledDate' => $registration->scheduled_date ? Carbon::parse($registration->scheduled_date)->format('Y-m-d') : null,
            ]);
        } else {
            return view('status', [
                'status' => 'Vaccinated',
                'scheduledDate' => $registration->scheduled_date ? Carbon::parse($registration->scheduled_date)->format('Y-m-d') : null,
            ]);
        }
    }

}
