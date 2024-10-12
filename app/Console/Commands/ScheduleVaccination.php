<?php

namespace App\Console\Commands;

use App\Mail\VaccinationScheduledMail;
use App\Models\CovidRegistration;
use App\Models\VaccineCenter;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ScheduleVaccination extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vaccination:schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schedule vaccination for users and send notification emails';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now();

        VaccineCenter::chunk(100, function ($centers) use ($today) {
            foreach ($centers as $center) {
                $covid_registration = CovidRegistration::with('vaccineCenter')
                    ->where('vaccine_center_id', $center->id)
                    ->where('status', 'Not scheduled')
                    ->take($center->daily_limit)
                    ->get();

                $instant_date = Carbon::now();
                // $nextAvailableDate = $this->getNextAvailableDate($today);

                foreach ($covid_registration as $registration) {
                    $registration->update([
                        'scheduled_date' => $instant_date->format('Y-m-d H:i:s'),
                        'status' => 'Scheduled',
                    ]);

                    Mail::to($registration->email)->send(new VaccinationScheduledMail($registration));
                }
            }
        });
    }

    private function getNextAvailableDate($date)
    {
        // Ensure the date is within weekdays (Sunday to Thursday)
        do {
            $date->addDay();
        } while ($date->isFriday() || $date->isSaturday());

        return $date->format('Y-m-d');
    }
}
