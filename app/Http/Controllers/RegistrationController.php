<?php

namespace App\Http\Controllers;

use App\Models\CovidRegistration;
use App\Models\VaccineCenter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        $vaccineCenters = VaccineCenter::all();
        return view('register', compact('vaccineCenters'));
    }
    public function store(Request $request)
    {
        $vaccineCenter = VaccineCenter::find($request->vaccine_center_id);

        $todayCount = CovidRegistration::where('vaccine_center_id', $vaccineCenter->id)
            ->whereDate('created_at', Carbon::today())
            ->count();

        if ($todayCount >= $vaccineCenter->daily_limit) {
            return back()->with('error', 'Daily limit reached for this center. Please select another center.');
        }

        $existingRegistration = CovidRegistration::where('nid', $request->get('nid'))->first();

        if ($existingRegistration) {
            return redirect('/status')->with([
                'status' => $existingRegistration->status,
                'scheduledDate' => $existingRegistration->scheduled_date,
                'nid' => $existingRegistration->nid,
            ]);
        }

        $validated = $request->validate([
            'nid' => 'required|unique:covid_registrations',
            'name' => 'required',
            'email' => 'required|email|unique:covid_registrations',
            'vaccine_center_id' => 'required|exists:vaccine_centers,id',
        ]);

        CovidRegistration::create([
            'nid' => $validated['nid'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'vaccine_center_id' => $validated['vaccine_center_id'],
            'status' => 'Not scheduled',
        ]);

        return redirect('/status')->with([
            'success' => 'Registration successful. Check your status.',
            'nid' => $validated['nid'],
        ]);

    }

    public function checkStatus(Request $request)
    {
        $nid = $request->input('nid') ?? session('nid');
        $message = session('success');

        $registration = CovidRegistration::where('nid', $nid)->first();

        if (!$registration) {
            $status = 'Not registered';
            return view('status', compact('status', 'message'));
        }

        $status = $registration->status ?? 'Not scheduled';
        $scheduledDate = $registration->scheduled_date;

        return view('status', compact('status', 'scheduledDate', 'message'));
    }
}
